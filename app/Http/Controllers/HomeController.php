<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RoleModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

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
                $filename = $file->getClientOriginalName();
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
}
