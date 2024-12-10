@extends('layouts.app')

@section('content')
<div class="card rzw-box-login">
    <div class="card-body">
        <img src="{{ asset('asset/img/logo.png') }}" alt="Login Icon" style="width: 110px; height: auto; margin-top: -10px; margin-bottom: 20px;">
        <h3 style="padding-bottom: 10px; color: #00b4cd;">Login</h4>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div class="form-group pt-3">
                    <div class="input-group">
                        <input type="text" class="form-control rzw-input @error('username') is-invalid @enderror" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-user-exclamation">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                                    <path d="M6 21v-2a4 4 0 0 1 4 -4h4c.348 0 .686 .045 1.008 .128" />
                                    <path d="M19 16v3" />
                                    <path d="M19 22v.01" />
                                </svg>
                            </span>
                        </div>
                        @error('username')
                            <span class="invalid-feedback text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group pt-3">
                    <div class="input-group">
                        <input type="password" class="form-control rzw-input @error('password') is-invalid @enderror" name="password" id="password" placeholder="Password">
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-lock">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M5 13a2 2 0 0 1 2 -2h10a2 2 0 0 1 2 2v6a2 2 0 0 1 -2 2h-10a2 2 0 0 1 -2 -2v-6z" />
                                    <path d="M11 16a1 1 0 1 0 2 0a1 1 0 0 0 -2 0" />
                                    <path d="M8 11v-4a4 4 0 1 1 8 0v4" />
                                </svg>
                            </span>
                        </div>
                        @error('password')
                            <span class="invalid-feedback text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4 rzw-btn"
                    style="background-color: #00b4cd; border: none;">Login</button>
            </form>
            <div class="text-center mt-2" style="margin-bottom: -20px;">
                <a href="<?= url('register') ?>"
                    style="color: #000; text-decoration: none; font-weight: 350; font-size: 15px;">Belum
                    Memiliki Akun</a> |
                <a href="<?= url('lupa-password') ?>"
                    style="color: #000; text-decoration: none; font-weight: 350; font-size: 15px;">Lupa Password</a>
            </div>
    </div>
</div>
@endsection
