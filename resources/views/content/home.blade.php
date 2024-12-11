@extends('layout')

@section('content')
    <div class="rzw-box-profile">
        <div class="card-body">
            <img src="{{ asset(Auth::user()->img ?? 'asset/img/profile.png') }}" alt="Login Icon" class="rzw-profile-img">
            <p style="font-weight: 400; padding-top: 10px;">Hallo, {{ Auth::user()->name }}</p>
            <a href="{{ url('profile') }}" class="btn btn-primary w-100 rzw-btn" style="background-color: #0049ff; color: #fff;">Edit Profile</a>
            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-primary w-100 rzw-btn">Keluar</button>
            </form>
        </div>
    </div>
    <div class="rzw-box-content">
        <div class="card-body">
            <div class="row">
                <div class="col-6">
                    <a href="{{ url('qc_air_baku') }}" class="btn btn-primary w-100 rzw-btn-content">QC
                        Air Botol</a>
                </div>
                <div class="col-6">
                    <a href="{{ url('dashboard/qc_air_cup') }}" class="btn btn-primary w-100 rzw-btn-content">QC
                        Air Cup</a>
                </div>
                <div class="<?= Auth::user()->name != 'viewers' ? 'col-6' : 'col-12' ?> pt-3">
                    <a href="{{ url('dashboard/qc_air_galon') }}" class="btn btn-primary w-100 rzw-btn-content">QC Air Galon</a>
                </div>
                @if(Auth::user()->name != 'viewers')
                <div class="col-6 pt-3">
                    <a href="{{ url('dashboard/qc_air_baku') }}" class="btn btn-primary w-100 rzw-btn-content">QC Air Baku</a>
                </div>
                @endif
            </div>
        </div>
    </div>

    @if(Auth::user()->role->name == 'manager')
        <div class="rzw-box-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <a href="{{ url('manage_account') }}" class="btn btn-primary w-100 rzw-btn-content" style="background-color: #dad300; color: #000;">
                            Manage Akun
                        </a>
                    </div>
                    <div class="col-6">
                        <a href="{{ url('export_all_excel') }}" class="btn btn-primary w-100 rzw-btn-content" style="background-color: green;">
                            Export All Excel
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
