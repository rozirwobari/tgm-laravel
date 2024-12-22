@extends('layouts.app')

@section('content')
    <div class="card rzw-box-login">
        <div class="card-body">
            <img src="{{ asset('asset/img/logo.png') }}" alt="Login Icon" style="width: 110px; height: auto; margin-top: -10px; margin-bottom: 20px;">
            <h3 style="padding-bottom: 10px; color: #00b4cd;">Reset Password</h4>
                <form action="{{ route('password.email') }}" method="POST">
                    @csrf
                    <div class="form-group pt-3">
                        <div class="input-group">
                            <input type="text" class="form-control rzw-input @error('email') is-invalid @enderror"
                                name = "email" id="email" placeholder="Username atau Email Terdaftar"
                                value="{{ $email ?? old('email') }}">
                            <div class="input-group-prepend">
                                <span class="rzw-icon-input">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icons-tabler-outline icon-tabler-user-exclamation">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.348 0 .686 .045 1.008 .128" />
                                        <path d="M19 16v3" />
                                        <path d="M19 22v.01" />
                                    </svg>
                                </span>
                            </div>
                            @error('email')
                                <span class="invalid-feedback text-start" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary w-100 mt-4 rzw-btn"
                        style="background-color: red; border: none;">Reset Password</button>
                </form>
                <div class="text-center mt-2" style="margin-bottom: -20px;">
                    <a href="{{ route('login') }}"
                        style="color: #000; text-decoration: none; font-weight: 350; font-size: 15px;">Sudah Memiliki
                        Akun</a> |
                    <a href="{{ route('register') }}"
                        style="color: #000; text-decoration: none; font-weight: 350; font-size: 15px;">Belum Memiliki
                        Akun</a>
                </div>
        </div>
    </div>
@endsection
