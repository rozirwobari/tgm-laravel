@extends('layouts.app')

@section('content')
<div class="card rzw-box-login">
    <div class="card-body">
        <img src="{{ url('asset/img/logo.png') }}" alt="Login Icon"
            style="width: 110px; height: auto; margin-top: -10px; margin-bottom: 20px;">
        <h3 style="padding-bottom: 10px; color: #00b4cd;">Daftar</h4>
            <form autocomplete="off" action="{{ route('register') }}" method="post">
                @csrf
                <div class="form-group pt-3">
                    <div class="input-group">
                        <input type="text" name="name"
                            class="form-control rzw-input @error('name') is-invalid @enderror"
                            id="name" placeholder="Nama Lengkap" value="<?= old('name') ?>">
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-id-badge-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 12h3v4h-3z" />
                                    <path
                                        d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                                    <path
                                        d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 16h2" />
                                    <path d="M14 12h4" />
                                </svg>
                            </span>
                        </div>
                        @error('name')
                            <span class="invalid-feedback text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group pt-3">
                    <div class="input-group">
                        <input type="text" name="username"
                            class="form-control rzw-input @error('username') is-invalid @enderror"
                            id="username" placeholder="Username" value="<?= old('username') ?>">
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-id-badge-2">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M7 12h3v4h-3z" />
                                    <path
                                        d="M10 6h-6a1 1 0 0 0 -1 1v12a1 1 0 0 0 1 1h16a1 1 0 0 0 1 -1v-12a1 1 0 0 0 -1 -1h-6" />
                                    <path
                                        d="M10 3m0 1a1 1 0 0 1 1 -1h2a1 1 0 0 1 1 1v3a1 1 0 0 1 -1 1h-2a1 1 0 0 1 -1 -1z" />
                                    <path d="M14 16h2" />
                                    <path d="M14 12h4" />
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
                        <input type="email" name="email"
                            class="form-control rzw-input @error('email') is-invalid @enderror" id="email"
                            placeholder="Email" value="<?= old('email') ?>">
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-mail">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 7a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2v-10z" />
                                    <path d="M3 7l9 6l9 -6" />
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
                <div class="form-group pt-3">
                    <div class="input-group">
                        <input type="password" name="password"
                            class="form-control rzw-input @error('password') is-invalid @enderror"
                            id="password" placeholder="Password">
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
                <div class="form-group pt-3">
                    <div class="input-group">
                        <input type="password" name="password_confirmation"
                            class="form-control rzw-input @error('password_confirmation') is-invalid @enderror"
                            id="password_confirmation" placeholder="Password Confirm">
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
                        @error('password_confirmation')
                            <span class="invalid-feedback text-start" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 mt-4 rzw-btn"
                    style="background-color: #00b4cd; border: none;">Daftar</button>
            </form>
            <div class="text-center mt-2" style="margin-bottom: -20px;">
                <a href="{{ url('login') }}"
                    style="color: #000; text-decoration: none; font-weight: 350; font-size: 15px;">Sudah Memiliki
                    Akun</a>
            </div>
    </div>
</div>
@endsection
