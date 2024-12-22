<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Auth;
class ManageUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->role->name != 'manager') {
            return redirect()->route('home')->with('alert', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini',
                'title' => 'Gagal',
            ]);
        }
        $accounts = User::all();
        return view('content.Account.index', compact('accounts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        if (Auth::user()->role->name != 'manager') {
            return redirect()->route('home')->with('alert', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini',
                'title' => 'Gagal',
            ]);
        }
        $account = User::find($id);
        $roles = RoleModel::all();
        return view('content.Account.edit', compact('account', 'roles'));
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
        if (Auth::user()->role->name != 'manager') {
            return redirect()->route('home')->with('alert', [
                'type' => 'error',
                'message' => 'Anda tidak memiliki izin untuk mengakses halaman ini',
                'title' => 'Gagal',
            ]);
        }
        $account = User::find($id);
        $account->update([
            'name' => $request->nama,
            'email' => $request->email,
            'role_id' => $request->role,
        ]);
        return redirect()->route('manage_user')->with('alert', [
            'type' => 'success',
            'message' => 'Akun berhasil diubah',
            'title' => 'Berhasil',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
