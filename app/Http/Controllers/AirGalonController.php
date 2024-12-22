<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QcAirGalon;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RZWHelper;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\BatchUpdateSpreadsheetRequest;
use Google\Service\Sheets\BatchUpdateValuesRequest;

use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AirGalonController extends Controller
{

    public function __construct()
    {
        $this->sheetId = "1GLCOL_RvBhWAB4g6hPlcBDiKmu3-iyHUMXYOkH9jfRM";
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = QcAirGalon::orderBy('created_at', 'desc')->get();
        return view('content.AirGalon.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('content.AirGalon.input');
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

        $data = new QcAirGalon();
        $data->user_id = Auth::user()->id;
        $data->shift = $request->shift;
        $data->data = json_encode($request->except(['_token', 'shift']));
        $data->save();

        return redirect()->route('qc_air_galon')->with('alert', [
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
        $details = DB::table('qc_air_galon')->where('id', $id)->first();
        return view('content.AirGalon.detail', compact('details'));
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

        $data = QcAirGalon::find($id);
        $data->shift = $request->shift;
        $data->data = json_encode($request->except(['_token', 'shift']));
        $data->save();

        return redirect()->route('qc_air_galon')->with('alert', [
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
            $spreadsheet = $service->spreadsheets->get($this->sheetId);
            $sheets = $spreadsheet->getSheets();
            $templateSheetId = null;

            foreach ($sheets as $sheet) {
                if ($sheet->getProperties()->getTitle() === 'template') {
                    $templateSheetId = $sheet->getProperties()->getSheetId();
                    break;
                }
            }
            if ($templateSheetId === null) {
                throw new \Exception("Sheet 'template' tidak ditemukan.");
            }

            // Buat request untuk duplikasi sheet
            $duplicateRequest = new \Google\Service\Sheets\Request([
                'duplicateSheet' => [
                    'sourceSheetId' => $templateSheetId,
                    'insertSheetIndex' => 0,
                    'newSheetName' => $sheetName,
                ],
            ]);

            $body = new BatchUpdateSpreadsheetRequest([
                'requests' => [$duplicateRequest],
            ]);

            $response = $service->spreadsheets->batchUpdate($this->sheetId, $body);
            $sheetId = $response->getReplies()[0]->getDuplicateSheet()->getProperties()->getSheetId();

        } catch (Exception $e) {
            throw $e;
        }
    }

    private function checkOrCreateSheet($client, $sheetName)
    {
        try {
            $service = new Sheets($client);
            $response = $service->spreadsheets->get($this->sheetId);
            $sheets = $response->getSheets();
            foreach ($sheets as $sheet) {
                if ($sheet->getProperties()->getTitle() == $sheetName) {
                    return true;
                }
            }
            return false;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function findEmptyRow($client, $sheetName)
    {
        try {
            $client->setApplicationName('Google Sheets API');
            $service = new Sheets($client);
            
            // Ambil data mulai dari A5
            $response = $service->spreadsheets_values->get($this->sheetId, $sheetName.'!A5:A');
            $values = $response->getValues();
            
            // Mulai pengecekan dari A5
            $rowNumber = 5;  // Mulai dari baris 5
            
            // Jika data kosong dari A5, langsung return A5
            if (empty($values)) {
                return 5;
            }
            
            // Cek satu per satu sel mulai dari A5
            foreach ($values as $row) {
                if (!isset($row[0]) || empty($row[0]) || trim($row[0]) === '') {
                    return 'A' . $rowNumber;
                }
                $rowNumber++;
            }
            
            // Jika semua terisi, return baris setelah data terakhir
            return (count($values) + 5);
    
        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function updateSheetCell($client, $range, $data)
    {
        try {
            $client->setApplicationName('Google Sheets API');
            $service = new Sheets($client);
            $body = new ValueRange([
                'values' => $data
            ]);
            $params = [
                'valueInputOption' => 'RAW'
            ];
            $result = $service->spreadsheets_values->update(
                $this->sheetId, 
                $range, 
                $body, 
                $params
            );

        } catch (\Exception $e) {
            throw $e;
        }
    }

    private function getColumnRange(int $start = 1, int $end = 39): array 
    {
        $columns = [];
        
        for ($i = $start; $i <= $end; $i++) {
            $columns[] = $this->numberToColumn($i);
        }
        
        return $columns;
    }

    private function numberToColumn($n): string 
    {
        $result = '';
        
        // Selama n lebih besar dari 0
        while ($n > 0) {
            $n--;
            $result = chr(65 + ($n % 26)) . $result;
            $n = floor($n / 26);
        }
        
        return $result;
    }

    private function ConvertNumber($value)
    {
        if (is_string($value)) {
            $cleanValue = str_replace(',', '.', $value);
            if (is_numeric($cleanValue)) {
                return (float)$cleanValue;
            }
        }
        return is_numeric($value) ? (float)$value : $value;
    }

    private function updateDataColumns(object $client, string $sheetName, int $index, object $datas)
    {
        try {
            $client->setApplicationName('Google Sheets API');
            $service = new Sheets($client);
            $columns = $this->getColumnRange(5, 39);
            $valueRanges = [];
            
            $array = (array) $datas;
            $data = array_values($array);
            foreach ($columns as $key => $column) {
                $valueRanges[] = new ValueRange([
                    'range' => "{$sheetName}!{$column}{$index}",
                    'values' => [[
                        $this->ConvertNumber($data[$key]) ?? null
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
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function approve(string $id)
    {
        $data = QcAirGalon::find($id);
        try {
            $parsedData = json_decode($data->data);
            $service = $this->getGoogleClient();
            $sheetName = "QC Air Galon ".date('F Y', time());
            $sheeted = $this->checkOrCreateSheet($service, $sheetName);
            if (!$sheeted) {
                $this->DuplicateSheet($service, $sheetName);
            }
            $rowIndex = $this->findEmptyRow($service, $sheetName);
            $rowNumber = $rowIndex - 4;
            $this->updateSheetCell(
                $service,
                "$sheetName!A$rowIndex",
                [
                    [
                        $rowNumber, 
                        RZWHelper::formatTanggalIndonesia($data->updated_at), 
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
            
            $this->updateDataColumns(
                $service, 
                $sheetName, 
                $rowIndex, 
                $parsedData,
            );

            $data->status = 1;
            $data->save();
            
            return redirect()
                ->route('qc_air_galon')
                ->with('alert', [
                    'type' => 'success',
                    'message' => 'Data berhasil disetujui.',
                    'title' => 'Data Disetujui'
                ]);
                
        } catch (\Exception $e) {
            throw $e;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function reject(string $id)
    {
        $data = QcAirGalon::find($id);
        $data->status = 2;
        $data->save();
        return redirect()->route('qc_air_galon')->with('alert', [
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
        $data = QcAirGalon::find($id);
        $data->delete();
        return redirect()->route('qc_air_galon')->with('alert', [
            'type' => 'success',
            'message' => 'Data berhasil dihapus',
            'title' => 'Berhasil'
        ]);
    }

    public function export()
    {
        $templatePath = storage_path('app/private/sheet/qc_air_baku.xlsx');
        $spreadsheet = IOFactory::load($templatePath);

        $templateSheet = $spreadsheet->getSheetByName('template');
        if (!$templateSheet) {
            return response()->json(['error' => 'Worksheet "templatel" tidak ditemukan'], 404);
        }

        $duplicatedSheet = clone $templateSheet;
        $WorkSheetName = 'QC Air Galon '.date('F Y', time());
        $duplicatedSheet->setTitle($WorkSheetName);
        $spreadsheet->addSheet($duplicatedSheet);

        foreach ($spreadsheet->getAllSheets() as $index => $sheet) {
            if ($WorkSheetName !== $sheet->getTitle()) {
                $spreadsheet->removeSheetByIndex(0);
            }
        }
        $datas = QcAirGalon::with('user')->get()->toArray();



        $startRow = 5;
        $columns = $this->getColumnRange(5, 42);
        $colomListed = [];
        foreach ($columns as $key => $column) {
            $colomListed[] = $column;
        }

        $listValues = [];
        foreach ($datas as $key => $value) {
            $duplicatedSheet->setCellValue("A{$startRow}", ($startRow - 4));
            $duplicatedSheet->setCellValue("B{$startRow}", RZWHelper::formatTanggalIndonesia($value['created_at']));
            $duplicatedSheet->setCellValue("C{$startRow}", $value['shift']);
            $duplicatedSheet->setCellValue("D{$startRow}", $value['user']['name']);
            $duplicatedSheet->setCellValue("AN{$startRow}", "Approve");
            
            $ColomIndex = 0;
            foreach (json_decode($value['data']) as $value) {
                $duplicatedSheet->setCellValue("{$colomListed[$ColomIndex]}{$startRow}", $this->ConvertNumber($value));
                $ColomIndex++;
            }
            $startRow++;
        }

        $fileName = 'qc_air_galon_'.date('Y-m-d_His').'.xlsx';
        $tempFilePath = "asset/excel/{$fileName}";
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempFilePath);
        return response()->download($tempFilePath)->deleteFileAfterSend();
    }
}
