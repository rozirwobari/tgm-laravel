<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QcAirBaku;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RZWHelper;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class AirBakuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QcAirBaku::orderBy('created_at', 'desc')->get();
        return view('content.AirBaku.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.AirBaku.input');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'shift' => 'required',
            ],[
                'shift.required' => 'Shift harus diisi',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $data = new QcAirBaku();
        $data->user_id = Auth::user()->id;
        $data->shift = $request->shift;
        $data->data = json_encode($request->except(['_token', 'shift']));
        $data->save();

        return redirect()->route('qc_air_baku')->with('alert', [
            'type' => 'success',
            'message' => 'Data berhasil disimpan',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $details = DB::table('qc_air_baku')->where('id', $id)->first();
        return view('content.AirBaku.detail', compact('details'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'shift' => 'required',
            ],[
                'shift.required' => 'Shift harus diisi',
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors())->withInput();
        }

        $data = QcAirBaku::find($id);
        $data->shift = $request->shift;
        $data->data = json_encode($request->except(['_token', 'shift']));
        $data->save();

        return redirect()->route('qc_air_baku')->with('alert', [
            'type' => 'success', 
            'message' => 'Data berhasil diupdate',
            'title' => 'Berhasil'
        ]);
    }

    private function getGoogleClient()
    {
        $client = new Client();
        $client->setApplicationName('Laravel Google Sheets Integration');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('app/private/google/credentials.json')); // Path ke credentials.json Anda
        return $client;
    }

    private function DuplicateSheet($client, $sheetName)
    {
        try {
            $service = new Sheets($client);

            // Dapatkan spreadsheet dan cari template sheet
            $spreadsheet = $service->spreadsheets->get(env('GOOGLE_SHEET_ID'));
            $sheets = $spreadsheet->getSheets();
            $templateSheetId = null;

            foreach ($sheets as $sheet) {
                if ($sheet->getProperties()->getTitle() === 'template') {
                    $templateSheetId = $sheet->getProperties()->getSheetId();
                    break;
                }
            }

            if ($templateSheetId === null) {
                return response()->json([
                    'success' => false,
                    'message' => "Sheet 'template' tidak ditemukan."
                ], Response::HTTP_NOT_FOUND);
            }

            // Buat request untuk duplikasi sheet
            $duplicateRequest = new Request([
                'duplicateSheet' => [
                    'sourceSheetId' => $templateSheetId,
                    'insertSheetIndex' => 0,
                    'newSheetName' => 'temp',
                ],
            ]);

            $body = new BatchUpdateSpreadsheetRequest([
                'requests' => [$duplicateRequest],
            ]);

            // Eksekusi duplikasi
            $response = $service->spreadsheets->batchUpdate(env('GOOGLE_SHEET_ID'), $body);
            $sheetId = $response->getReplies()[0]->getDuplicateSheet()->getProperties()->getSheetId();

            // Update nama sheet yang baru
            $updateRequest = new Request([
                'updateSheetProperties' => [
                    'properties' => [
                        'sheetId' => $sheetId,
                        'title' => $sheetName,
                    ],
                    'fields' => 'title',
                ],
            ]);

            $updateBody = new BatchUpdateSpreadsheetRequest([
                'requests' => [$updateRequest],
            ]);

            $service->spreadsheets->batchUpdate(env('GOOGLE_SHEET_ID'), $updateBody);

            return response()->json([
                'success' => true,
                'message' => "Sheet berhasil diduplikasi dengan nama '$sheetName'",
                'sheetId' => $sheetId
            ], Response::HTTP_OK);

        } catch (Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function checkOrCreateSheet($client, $sheetName)
    {
        try {
            $service = new Sheets($client);
            $response = $service->spreadsheets->get(env('GOOGLE_SHEET_ID'));
            $sheets = $response->getSheets();
            
            foreach ($sheets as $sheet) {
                if ($sheet->getProperties()->getTitle() == $sheetName) {
                    return response()->json([
                        'success' => true,
                        'message' => 'Sheet ditemukan'
                    ]);
                }
            }
            $this->DuplicateSheet($client, $sheetName);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan: ' . $e->getMessage()
            ], 500);
        }
    }

    private function findEmptyRow($client, $sheetName)
    {
        try {
            $client->setApplicationName('Google Sheets API');
            $service = new Sheets($client);
            $response = $service->spreadsheets_values->get(env('GOOGLE_SHEET_ID'), $range);
            $values = $response->getValues();

            return $values;

        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error checking sheet: ' . $e->getMessage()
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function updateSheetCell($client, $range, $data)
    {
        try {
            $body = new ValueRange([
                'values' => $data
            ]);
            $params = [
                'valueInputOption' => 'RAW'
            ];
            $result = $service->spreadsheets_values->update(
                env('GOOGLE_SHEET_ID'), 
                $range, 
                $body, 
                $params
            );

        } catch (\Exception $e) {
            throw new \App\Exceptions\GoogleSheetException($e->getMessage());
        }
    }

    private function getColumnRange(int $start = 1, int $end = 39): array 
    {
        return array_map(
            fn($i) => chr(64 + $i),
            range($start, $end)
        );
    }

    private function updateDataColumns(object $service, string $sheetName, int $index, object $data)
    {
        try {
            $columns = $this->getColumnRange(5, 39);
            $valueRanges = [];
            
            foreach ($columns as $key => $column) {
                $valueRanges[] = new ValueRange([
                    'range' => "{$sheetName}!{$column}{$index}",
                    'values' => [[
                        $data[$key] ?? null
                    ]]
                ]);
            }

            $body = new BatchUpdateValuesRequest([
                'valueInputOption' => 'RAW',
                'data' => $valueRanges
            ]);

            $service->spreadsheets_values->batchUpdate(
                $this->sheetId,
                $body
            );
        } catch (\Exception $e) {
            throw new \App\Exceptions\GoogleSheetException($e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function approve(string $id)
    {
        $data = QcAirBaku::find($id);
        // $data->status = 1;
        // $data->save();

        try {
            $qcData = QcAirBaku::with('user')->findOrFail($id);
            $parsedData = json_decode($data->data);
            
            $service = $this->getGoogleClient();
            $sheetName = date('F Y', time());
            
            // Cek dan buat sheet jika belum ada
            $this->checkOrCreateSheet($service, $sheetName);
            
            // Cari baris kosong
            $rowIndex = $this->findEmptyRow($service, $sheetName);
            $rowNumber = $rowIndex - 4;

            // Update informasi dasar
            $this->updateSheetCell(
                $service,
                "$sheetName!A$rowIndex",
                [
                    [
                        $rowNumber, 
                        $data->updated_at, 
                        $data->shift, 
                        $data->user->name
                    ]
                ]
            );
            
            // Update status approval
            $this->updateSheetCell(
                $service,
                "$sheetName!AN$rowIndex",
                [
                    ['Approval']
                ]
            );
            
            // Update data fisikokimia
            $this->updateDataColumns(
                $service, 
                $sheetName, 
                $rowIndex, 
                $parsedData,
            );
            
            // Update status di database
            $qcData->update(['status' => 1]);
            
            return redirect()
                ->route('qc_air_baku')
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Data berhasil disetujui.',
                    'title' => 'Data Disetujui'
                ]);
                
        } catch (\Exception $e) {
            report($e); // Log error
            
            return redirect()
                ->route('qc_air_baku')
                ->with('alert', [
                    'type' => 'error',
                    'message' => 'Terjadi kesalahan saat memproses data.',
                    'title' => 'Error'
                ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function reject(string $id)
    {
        $data = QcAirBaku::find($id);
        $data->status = 2;
        $data->save();
        return redirect()->route('qc_air_baku')->with('alert', [
            'type' => 'success',
            'message' => 'Data Berjasi di Reject',
            'title' => 'Berhasil'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = QcAirBaku::find($id);
        $data->delete();
        return redirect()->route('qc_air_baku')->with('alert', [
            'type' => 'success',
            'message' => 'Data berhasil dihapus',
            'title' => 'Berhasil'
        ]);
    }
}
