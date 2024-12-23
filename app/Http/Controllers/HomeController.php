<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;


use PhpOffice\PhpSpreadsheet\IOFactory;
use App\Models\QcAirBaku;
use App\Models\QcAirBotol;
use App\Models\QcAirCup;
use App\Models\QcAirGalon;
use App\Helpers\RZWHelper;
use Google\Service\Sheets\BatchUpdateValuesRequest;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('content.home');
    }

    public function profile()
    {
        $roles = RoleModel::all();
        return view('content.profile', compact('roles'));
    }

    public function save_profile(Request $request)
    {
        $id = Auth::user()->id;
        try {
            $request->validate([
                'nama' => 'required',
                'email' => 'required|email',
            ]);

            $user = User::find($id);

            if ($request->hasFile('foto_profile')) {
                $file = $request->file('foto_profile');
                $filename = uniqid() . '_' . time() . '.' . $file->getClientOriginalExtension();
                if(file_exists($user->img)) {
                    unlink($user->img);
                }
                $file->move('asset/img/', $filename); 
                $user->img = 'asset/img/'.$filename;
                $user->save();
            }

            if ($request->password_lama) {
                if (Hash::check($request->password_lama, $user->password)) {
                    $user->password = Hash::make($request->password_baru);
                    $user->save();
                } else {
                    return redirect()->back()->withErrors(['password_lama' => 'Password lama tidak sesuai']);
                }
            }

            $user->name = $request->nama;
            $user->email = $request->email;
            $user->save();
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->errors());
        }

        return redirect()->back()->with('alert', [
            'type' => 'success',
            'message' => 'Profile berhasil diubah',
            'title' => 'Berhsil',
        ]);
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


    private function ExportBaku($templateSheetBaku, $spreadsheet)
    {
        $duplicatedSheetBaku = clone $templateSheetBaku;
        $WorkSheetNameBaku = 'QC Air Baku '.date('F Y', time());
        $duplicatedSheetBaku->setTitle($WorkSheetNameBaku);
        $spreadsheet->addSheet($duplicatedSheetBaku);

        $datas = QcAirBaku::with('user')->get()->toArray();
        $startRow = 5;
        $columns = $this->getColumnRange(5, 42);
        $colomListed = [];
        foreach ($columns as $key => $column) {
            $colomListed[] = $column;
        }

        $listValues = [];
        foreach ($datas as $key => $value) {
            $duplicatedSheetBaku->setCellValue("A{$startRow}", ($startRow - 4));
            $duplicatedSheetBaku->setCellValue("B{$startRow}", RZWHelper::formatTanggalIndonesia($value['created_at']));
            $duplicatedSheetBaku->setCellValue("C{$startRow}", $value['shift']);
            $duplicatedSheetBaku->setCellValue("D{$startRow}", $value['user']['name']);
            $duplicatedSheetBaku->setCellValue("AN{$startRow}", "Approve");
            
            $ColomIndex = 0;
            foreach (json_decode($value['data']) as $value) {
                $duplicatedSheetBaku->setCellValue("{$colomListed[$ColomIndex]}{$startRow}", $this->ConvertNumber($value));
                $ColomIndex++;
            }
            $startRow++;
        }
    }

    private function ExportBotol($templateSheetBotol, $spreadsheet)
    {
        $duplicatedSheetBotol = clone $templateSheetBotol;
        $WorkSheetNameBotol = 'QC Air Botol '.date('F Y', time());
        $duplicatedSheetBotol->setTitle($WorkSheetNameBotol);
        $spreadsheet->addSheet($duplicatedSheetBotol);

        $datas = QcAirBotol::with('user')->get()->toArray();
        $startRow = 5;
        $columns = $this->getColumnRange(5, 42);
        $colomListed = [];
        foreach ($columns as $key => $column) {
            $colomListed[] = $column;
        }

        $listValues = [];
        foreach ($datas as $key => $value) {
            $duplicatedSheetBotol->setCellValue("A{$startRow}", ($startRow - 4));
            $duplicatedSheetBotol->setCellValue("B{$startRow}", RZWHelper::formatTanggalIndonesia($value['created_at']));
            $duplicatedSheetBotol->setCellValue("C{$startRow}", $value['shift']);
            $duplicatedSheetBotol->setCellValue("D{$startRow}", $value['user']['name']);
            $duplicatedSheetBotol->setCellValue("AN{$startRow}", "Approve");
            
            $ColomIndex = 0;
            foreach (json_decode($value['data']) as $value) {
                $duplicatedSheetBotol->setCellValue("{$colomListed[$ColomIndex]}{$startRow}", $this->ConvertNumber($value));
                $ColomIndex++;
            }
            $startRow++;
        }
    }

    private function ExportCup($templateSheetCup, $spreadsheet)
    {
        $duplicatedSheetCup = clone $templateSheetCup;
        $WorkSheetNameCup = 'QC Air Cup '.date('F Y', time());
        $duplicatedSheetCup->setTitle($WorkSheetNameCup);
        $spreadsheet->addSheet($duplicatedSheetCup);

        $datas = QcAirCup::with('user')->get()->toArray();
        $startRow = 5;
        $columns = $this->getColumnRange(5, 42);
        $colomListed = [];
        foreach ($columns as $key => $column) {
            $colomListed[] = $column;
        }

        $listValues = [];
        foreach ($datas as $key => $value) {
            $duplicatedSheetCup->setCellValue("A{$startRow}", ($startRow - 4));
            $duplicatedSheetCup->setCellValue("B{$startRow}", RZWHelper::formatTanggalIndonesia($value['created_at']));
            $duplicatedSheetCup->setCellValue("C{$startRow}", $value['shift']);
            $duplicatedSheetCup->setCellValue("D{$startRow}", $value['user']['name']);
            $duplicatedSheetCup->setCellValue("AN{$startRow}", "Approve");
            
            $ColomIndex = 0;
            foreach (json_decode($value['data']) as $value) {
                $duplicatedSheetCup->setCellValue("{$colomListed[$ColomIndex]}{$startRow}", $this->ConvertNumber($value));
                $ColomIndex++;
            }
            $startRow++;
        }
    }

    private function ExportGalon($templateSheetGalon, $spreadsheet)
    {
        $duplicatedSheetGalon = clone $templateSheetGalon;
        $WorkSheetNameGalon = 'QC Air Galon '.date('F Y', time());
        $duplicatedSheetGalon->setTitle($WorkSheetNameGalon);
        $spreadsheet->addSheet($duplicatedSheetGalon);

        $datas = QcAirGalon::with('user')->get()->toArray();
        $startRow = 5;
        $columns = $this->getColumnRange(5, 42);
        $colomListed = [];
        foreach ($columns as $key => $column) {
            $colomListed[] = $column;
        }

        $listValues = [];
        foreach ($datas as $key => $value) {
            $duplicatedSheetGalon->setCellValue("A{$startRow}", ($startRow - 4));
            $duplicatedSheetGalon->setCellValue("B{$startRow}", RZWHelper::formatTanggalIndonesia($value['created_at']));
            $duplicatedSheetGalon->setCellValue("C{$startRow}", $value['shift']);
            $duplicatedSheetGalon->setCellValue("D{$startRow}", $value['user']['name']);
            $duplicatedSheetGalon->setCellValue("AN{$startRow}", "Approve");
            
            $ColomIndex = 0;
            foreach (json_decode($value['data']) as $value) {
                $duplicatedSheetGalon->setCellValue("{$colomListed[$ColomIndex]}{$startRow}", $this->ConvertNumber($value));
                $ColomIndex++;
            }
            $startRow++;
        }
    }


    public function exportAllExcel()
    {
        $templatePath = storage_path('app/private/sheet/qc_air_baku.xlsx');
        $spreadsheet = IOFactory::load($templatePath);

        $templateSheetBaku = $spreadsheet->getSheetByName('template_baku');
        $templateSheet = $spreadsheet->getSheetByName('template');
        if (!$templateSheetBaku) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Worksheet "template_baku" tidak ditemukan',
                'title' => 'Gagal'
            ]);
        }
        if (!$templateSheet) {
            return redirect()->back()->with('alert', [
                'type' => 'error',
                'message' => 'Worksheet "template" tidak ditemukan',
                'title' => 'Gagal'
            ]);
        }


        $this->ExportBaku($templateSheetBaku, $spreadsheet);
        $this->ExportBotol($templateSheet, $spreadsheet);
        $this->ExportCup($templateSheet, $spreadsheet);
        $this->ExportGalon($templateSheet, $spreadsheet);


        foreach ($spreadsheet->getAllSheets() as $index => $sheet) {
            if ($sheet->getTitle() == 'template_baku' || $sheet->getTitle() == 'template') {
                $spreadsheet->removeSheetByIndex(0);
            }
        }

        $fileName = 'qc_air_all_'.date('Y-m-d_His').'.xlsx';
        $tempFilePath = "asset/excel/{$fileName}";
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($tempFilePath);
        response()->download($tempFilePath)->deleteFileAfterSend();
        return exit;
    }
}
