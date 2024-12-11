<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QcAirBaku;
use Illuminate\Support\Facades\Auth;
use App\Helpers\RZWHelper;

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

    /**
     * Remove the specified resource from storage.
     */
    public function approve(string $id)
    {
        $data = QcAirBaku::find($id);
        $data->status = 1;
        $data->save();
        return redirect()->route('qc_air_baku')->with('alert', [
            'type' => 'success',
            'message' => 'Data Berjasi di Approve',
            'title' => 'Berhasil'
        ]);
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
