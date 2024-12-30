@php
    use App\Helpers\RZWHelper;
@endphp
@extends('layout')

@section('content')
    <div class="rzw-container" style="display: flex;">
        <div class="rzw-box-content" style="flex: 0 0 15%; padding: 1px; border-radius: 10px 0 0 10px;">
            <a href="<?= url('/') ?>">
                <h5 style="font-weight: 600; padding-top: 0.9vh;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none"
                        stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                        class="icon icon-tabler icons-tabler-outline icon-tabler-home">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12l-2 0l9 -9l9 9l-2 0" />
                        <path d="M5 12v7a2 2 0 0 0 2 2h10a2 2 0 0 0 2 -2v-7" />
                        <path d="M9 21v-6a2 2 0 0 1 2 -2h2a2 2 0 0 1 2 2v6" />
                    </svg>
                </h5>
            </a>
        </div>
        <div class="rzw-box-content" style="flex: 0 0 85%; padding: 1px; border-radius: 0 10px 10px 0;">
            <h5 class="pt-2" style="font-weight: 600;">QC Air Baku</h5>
        </div>
    </div>

    @if (Auth::user()->name != 'viewers')
        <div class="rzw-box-content">
            <div class="card-body">
                <div class="row">
                    <div class="col-12">
                        <a href="{{ url('/qc_air_baku/input') }}" class="btn btn-primary w-100 rzw-btn-content">Input
                            Data</a>
                    </div>
                    <div class="col-12 pt-3">
                        <a href="{{ url('/qc_air_baku/export') }}" class="btn btn-primary w-100 rzw-btn-content"
                            onclick="handleExport(event, 'Download Data...')" style="background-color: green;">
                            Export
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-3 overflow-auto"
        style="{{ Auth::user()->name != 'viewers' ? 'max-height: 70vh;' : 'max-height: 86vh;' }} scrollbar-width: none;">
        @foreach ($data as $value)
            <div class="rzw-box-content text-start">
                <a href="{{ url('/qc_air_baku/detail/' . $value->id) }}">
                    <div class="card-body">
                        <p class="fw-bold">{{ RZWHelper::formatTanggalIndonesia($value->created_at) }} [<span
                                style="color: {{ $value->status == 0 ? '#c6a200' : ($value->status == 1 ? 'green' : 'red') }}">{{ $value->status == 0 ? 'Pending' : ($value->status == 1 ? 'Approve' : 'Reject') }}</span>]
                        </p>
                        <table style="font-size: 0.8em;">
                            <tr>
                                <th style="text-align: center;">Index</th>
                                <th style="text-align: center;">Warna</th>
                                <th style="text-align: center;">Status</th>
                                <th style="text-align: center;">Keterangan</th>
                            </tr>
                            <tr>
                                <td style="text-align: center;">A</td>
                                <td style="background-color: green; text-align: center; color: white;">Hijau</td>
                                <td>LOLOS</td>
                                <td>Produk/ bahan kualitas baik sesuai standar</td>
                            </tr>
                            <tr>
                                <td style="text-align: center; text-align: center;">B</td>
                                <td style="background-color: yellow;">Kuning</td>
                                <td>LOLOS</td>
                                <td>Produk/ bahan pada kondisi kurang baik namun masih sesuai standar atau masih di
                                    toleransi</td>
                            </tr>
                            <tr>
                                <td style="text-align: center;">C</td>
                                <td style="background-color: red; text-align: center; color: white;">Merah</td>
                                <td>RIJECT</td>
                                <td>Produk kondisi tidak baik, tidak sesuai standar</td>
                            </tr>
                        </table>
                    </div>
                </a>
            </div>
        @endforeach
    </div>
@endsection