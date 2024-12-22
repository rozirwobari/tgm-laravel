<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    protected function validateEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|string',
        ]);
    }

    protected function credentials(Request $request)
    {
        $field = filter_var($request->get('email'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
        
        return array($field => $request->get('email'));
    }

    protected function sendResetLinkResponse(Request $request, $response)
    {
        return redirect()->route('login')->with('alert', [
            'type' => 'success',
            'message' => 'Password berhasil direset!',
            'title' => 'Berhasil'
        ]);
    }
}
