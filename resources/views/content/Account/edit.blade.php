@extends('layout')

@section('content')
    <div class="rzw-container" style="display: flex;">
        <div class="rzw-box-content" style="flex: 0 0 15%; padding: 1px; border-radius: 10px 0 0 10px;">
            <a href="<?= url('/manage_user') ?>">
                <h5 style="font-weight: 600; padding-top: 0.9vh;">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="22"  height="22"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
            </h5>
        </a>
    </div>
    <div class="rzw-box-content" style="flex: 0 0 85%; padding: 1px; border-radius: 0 10px 10px 0;">
        <h5 class="pt-2" style="font-weight: 600;">Edit Akun</h5>
    </div>
</div>

    <form action="{{ url('save_account/' . $account['id']) }}" method="post">
        @csrf
        <div class="rzw-box-content">
            <div class="card-body">
                <label for="username" style="text-align: left;">Username</label>
                <div class="input-group my-3">
                    <input type="text"
                        class="form-control rzw-input @error('username') is-invalid @enderror" name="username"
                        id="username" placeholder="Username" value="{{ $account['username'] }}" disabled>
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

                    @error('username')
                        <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <label for="nama" style="text-align: left;">Nama</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('nama') is-invalid @enderror" name="nama"
                        id="nama" placeholder="Nama" value="{{ $account['name'] }}" required>
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

                    @error('nama')
                        <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <label for="email" style="text-align: left;">Email</label>
                <div class="input-group my-3">
                    <input type="text" class="form-control rzw-input @error('email') is-invalid @enderror" name="email"
                        id="email" placeholder="Email" value="{{ $account['email'] }}" required>
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
                        <?= session('input.email') ?>
                    </div>
                </div>
            </div>
        </div>


        <div class="rzw-box-content">
            <div class="card-body">
                <label for="role" style="text-align: left;">Role</label>
                <div class="input-group my-3">
                    <select class="form-control rzw-input @error('role') is-invalid @enderror" name="role"
                        id="role" required>
                        <option value="">Pilih Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role['id'] }}" {{ $account->role_id == $role['id'] ? 'selected' : '' }}>
                                {{ $role['label'] }}</option>
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
                    @error('role')
                        <div id="validationServerUsernameFeedback" class="invalid-feedback text-start">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
            </div>
        </div>


        <div class="rzw-box-content">
            <div class="row">
                <div class="col-<?= session()->get('id') != $account['id'] ? '6' : '12' ?>">
                    <button type="submit" class="btn btn-primary w-100 rzw-btn-content">Simpan</button>
                </div>
                @if(session()->get('id') != $account['id'])
                <div class="col-6">
                    <a href="javascript:void(0)" class="btn btn-primary w-100"
                        onclick="DeleteUser({{ $account['id'] }})"
                        style="background-color: #f3e100; border: none; border-radius: 8px; color: black;">Hapus</a>
                    </div>
                @endif
            </div>
        </div>
    </form>
@endsection
