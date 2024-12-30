@extends('layout')

@section('title', 'Edit User')

@section('content')
    <div class="rzw-container" style="display: flex;">
        <div class="rzw-box-content" style="flex: 0 0 15%; padding: 1px; border-radius: 10px 0 0 10px;">
            <a href="{{ url('/') }}">
                <h5 style="font-weight: 600; padding-top: 0.9vh;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M15 6l-6 6l6 6" />
                    </svg>
                </h5>
            </a>
        </div>
        <div class="rzw-box-content" style="flex: 0 0 85%; padding: 1px; border-radius: 0 10px 10px 0;">
            <h5 class="pt-2" style="font-weight: 600;">Edit User</h5>
        </div>
    </div>

    <form action="{{ url('profile') }}" method="post" enctype="multipart/form-data" id="profileForm">
        @csrf
        <div class="rzw-box-profile" style="margin-top: 10%;">
            <div class="card-body">
                <label for="username" style="text-align: left;">Username</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('username') is-invalid @enderror"
                        name="username" id="username" placeholder="Username" value="{{ Auth::user()->username }}" disabled>
                    <div class="input-group-prepend">
                        <span class="rzw-icon-input" style="z-index: 5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12h4" />
                                <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                            </svg>
                        </span>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <label for="nama" style="text-align: left;">Nama</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('nama') is-invalid @enderror" name="nama"
                        id="nama" placeholder="Nama" value="{{ Auth::user()->name }}" required>
                    <div class="input-group-prepend">
                        <span class="rzw-icon-input" style="z-index: 5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12h4" />
                                <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                            </svg>
                        </span>
                    </div>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                        @error('nama')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-body">
                <label for="email" style="text-align: left;">Email</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="Email" value="{{ Auth::user()->email }}" required>
                    <div class="input-group-prepend">
                        <span class="rzw-icon-input" style="z-index: 5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12h4" />
                                <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                            </svg>
                        </span>
                    </div>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-body">
                <label for="role" style="text-align: left;">Role</label>
                <div class="input-group my-3">
                    <select class="form-control rzw-input @error('role') is-invalid @enderror" name="role"
                        id="role" required>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}" {{ Auth::user()->role_id == $role->id ? 'selected' : '' }}>
                                {{ $role->label }}</option>
                        @endforeach
                    </select>
                    <div class="input-group-prepend">
                        <span class="rzw-icon-input" style="z-index: 5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12h4" />
                                <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                            </svg>
                        </span>
                    </div>
                    <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                        @error('role')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>

            <div class="card-body">
                <label for="nama" class="text-start">Password Lama</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('password_lama') is-invalid @enderror"
                        name="password_lama" id="password_lama" placeholder="Password Lama">
                    <div class="input-group-prepend">
                        <span class="rzw-icon-input" style="z-index: 5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12h4" />
                                <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                            </svg>
                        </span>
                        @error('password_lama')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card-body">
                <label for="nama" class="text-start">Password Baru</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('password_baru') is-invalid @enderror"
                        name="password_baru" id="password_baru" placeholder="Password Baru">
                    <div class="input-group-prepend">
                        <span class="rzw-icon-input" style="z-index: 5;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round"
                                class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M10 12h4" />
                                <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                            </svg>
                        </span>
                        @error('password_baru')
                            <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>

                <div class="card-body">
                    <label for="nama" class="text-start">Profile Picture</label>
                    <div class="input-group my-3">
                        <input type="file" class="form-control @error('foto_profile') is-invalid @enderror"
                            name="foto_profile" id="foto_profile" placeholder="Profile Picture"
                            onchange="readURL(this);">
                        <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                            @error('foto_profile')
                                {{ $message }}
                            @enderror
                        </div>
                    </div>

                    <div class="text-center">
                        <img src="{{ asset(Auth::user()->img ?? 'asset/img/profile.png') }}" alt="Login Icon"
                            class="rzw-profile-img" id="profileImg">
                    </div>
                </div>

                <div class="py-3">
                    <button type="submit" class="btn btn-primary w-100 rzw-submit-loading"
                        style="background-color: #00b4cd; border: none; border-radius: 8px;">Simpan</button>
                </div>
            </div>
    </form>

    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImg').attr('src', e.target.result);
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endsection
