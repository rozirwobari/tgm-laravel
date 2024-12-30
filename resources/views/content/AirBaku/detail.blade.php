@php
    use App\Helpers\RZWHelper;
    $decode_qc = json_decode($details->data);
@endphp
@extends('layout')

@section('content')
    <div class="rzw-container" style="display: flex;">
        <div class="rzw-box-content" style="flex: 0 0 15%; padding: 1px; border-radius: 10px 0 0 10px;">
            <a href="{{ url('/qc_air_baku') }}">
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
            <h5 class="pt-2" style="font-weight: 600;">QC Air Baku</h5>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-start">
                <h3 class="text-center">Keterangan Fisikokimia</h3>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 10px;">TDS : </p>
                    <span class="rzw-keterangan-green">0-130</span>
                    <span class="rzw-keterangan-yellow">130-150</span>
                    <span class="rzw-keterangan-red">150&lt;</span>
                </div>
                <div style="display: flex; flex-direction: row;" class="mt-2">
                    <p style="margin-right: 10px;">PH : </p>
                    <span class="rzw-keterangan-green">6.5-7.5</span>
                    <span class="rzw-keterangan-yellow">7.5-8.5</span>
                    <span class="rzw-keterangan-red">8.5&lt;</span>
                </div>
                <div style="display: flex; flex-direction: row;" class="mt-2">
                    <p style="margin-right: 10px;">KERUHAN : </p>
                    <span class="rzw-keterangan-green">0.0-2.0</span>
                    <span class="rzw-keterangan-yellow">2.1-5.0</span>
                    <span class="rzw-keterangan-red">5.1&lt;</span>
                </div>
            </div>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-start">
                <h3 class="text-center">Keterangan Organoleptik</h3>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 10px;">RASA : </p>
                    <span class="rzw-keterangan-green">Normal</span>
                    <span class="rzw-keterangan-red">Tidak Normal</span>
                </div>
                <div style="display: flex; flex-direction: row;" class="mt-2">
                    <p style="margin-right: 10px;">AROMA : </p>
                    <span class="rzw-keterangan-green">Normal</span>
                    <span class="rzw-keterangan-red">Tidak Normal</span>
                </div>
                <div style="display: flex; flex-direction: row;" class="mt-2">
                    <p style="margin-right: 10px;">WARNA : </p>
                    <span class="rzw-keterangan-green">Normal</span>
                    <span class="rzw-keterangan-red">Tidak Normal</span>
                </div>
            </div>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-start">
                <h3 class="text-center">Keterangan Mikrobiologi</h3>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 10px; font-size: 14px;">ALT : </p>
                    <span class="rzw-keterangan-green" style="font-size: 14px;">
                        < 1.0 X 10^1 </span>
                            <span class="rzw-keterangan-yellow" style="font-size: 14px;">
                                1.0 X 10^1 - 10^2
                            </span>
                            <span class="rzw-keterangan-red" style="font-size: 14px;">
                                1.0 x10^2&lt;
                            </span>
                </div>
                <div style="display: flex; flex-direction: row; font-size: 14px;" class="mt-2">
                    <p style="margin-right: 10px;">EC : </p>
                    <span class="rzw-keterangan-green">TTD</span>
                    <span class="rzw-keterangan-red">1=/< </span>
                </div>
            </div>
        </div>
    </div>


    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-start">
                <h3 class="text-center">Detail Petugas</h3>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 3px;">Tanggal & Waktu : <span
                            class="p-2"style="font-weight: 600;">{{ RZWHelper::formatTanggalIndonesia($details->created_at) }}</span>
                    </p>
                </div>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 3px;">Tanggal & Waktu Di Update : <span class="p-2"
                            style="font-weight: 600;">{{ RZWHelper::formatTanggalIndonesia($details->updated_at) }}</span>
                    </p>
                </div>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 3px;">Petugas : <span class="p-2"
                            style="font-weight: 600;">{{ Auth::user()->name }}</span></p>
                </div>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 3px;">Status : <span class="p-2"
                            style="font-weight: 600; color: {{ $details->status == 0 ? '#c6a200' : ($details->status == 1 ? 'green' : 'red') }};">{{ $details->status == 0 ? 'Pending' : ($details->status == 1 ? 'Approve' : 'Reject') }}</span>
                    </p>
                </div>
                <div style="display: flex; flex-direction: row;">
                    <p style="margin-right: 3px;">Shift/Lokasi : <span class="p-2"
                            style="font-weight: 600;">{{ $details->shift }}</span></p>
                </div>
            </div>
        </div>
    </div>
    <form action="{{ url('/qc_air_baku/edit/' . $details->id) }}" method="POST">
        @csrf
        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>Shift</h3>
                </div>
                <div class="input-group my-3">
                    <select class="form-control rzw-input {{ session('input.shift') ? 'is-invalid' : '' }}" name="shift"
                        id="shift"
                        {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <option value="">Pilih Shift</option>
                        <option value="Sumber 1" {{ $details->shift == 'Sumber 1' ? 'selected' : '' }}>Sumber 1</option>
                        <option value="Sumber 2" {{ $details->shift == 'Sumber 2' ? 'selected' : '' }}>Sumber 2</option>
                        <option value="Sumber 3" {{ $details->shift == 'Sumber 3' ? 'selected' : '' }}>Sumber 3</option>
                        <option value="Tangki" {{ $details->shift == 'Tangki' ? 'selected' : '' }}>Tangki</option>
                        <option value="WT" {{ $details->shift == 'WT' ? 'selected' : '' }}>WT</option>
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
                        @error('shift')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="rzw-box-content" style="padding: 0px; margin-top: 15px;">
            <p class="p-2" style="font-weight: 600;">FISIKOKIMIA</p>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>TDS</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'tds_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ $item == null ? 'white' : ($item >= 0 && $item <= 130 ? 'green' : ($item > 130 && $item <= 150 ? '#ecd700' : '#ff0000')) }}; color: {{ $item == null ? 'black' : ($item >= 0 && $item <= 130 ? 'white' : ($item > 130 && $item <= 150 ? 'black' : 'white')) }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>PH</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'ph_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ $item == null ? 'white' : ($item >= 6.5 && $item <= 7.5 ? 'green' : ($item > 7.5 && $item <= 8.5 ? '#ecd700' : '#ff0000')) }}; color: {{ $item == null ? 'black' : ($item >= 6.5 && $item <= 7.5 ? 'white' : ($item > 7.5 && $item <= 8.5 ? 'black' : 'white')) }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>KERUHAN</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'keruhan_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ $item == null ? 'white' : ($item >= 0 && $item <= 2.0 ? 'green' : ($item >= 2.1 && $item <= 5.0 ? '#ecd700' : '#ff0000')) }}; color: {{ $item == null ? 'black' : ($item >= 0 && $item <= 2.0 ? 'white' : ($item >= 2.1 && $item <= 5.0 ? 'black' : 'white')) }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rzw-box-content" style="padding: 0px; margin-top: 35px;">
            <p class="p-2" style="font-weight: 600;">ORGANOLEPTIK</p>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>RASA</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'rasa_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ strpos(strtolower($item), 'normal') === 0 ? 'green' : ($item == null ? 'white' : 'red') }}; color: {{ $item == null ? 'black' : 'white' }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>AROMA</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'aroma_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ strpos(strtolower($item), 'normal') === 0 ? 'green' : ($item == null ? 'white' : 'red') }}; color: {{ $item == null ? 'black' : 'white' }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>WARNA</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'warna_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ strpos(strtolower($item), 'normal') === 0 ? 'green' : ($item == null ? 'white' : 'red') }}; color: {{ $item == null ? 'black' : 'white' }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>


        <div class="rzw-box-content" style="padding: 0px; margin-top: 35px;">
            <p class="p-2" style="font-weight: 600;">MIKROBIOLGI</p>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>ALT</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'alt_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ $item == null ? 'white' : ($item >= 0 && $item < pow(10, 1) ? 'green' : ($item >= pow(10, 1) && $item <= 1.0 * pow(10, 1) - pow(10, 2) ? '#ecd700' : '#ff0000')) }}; color: {{ $item == null ? 'black' : ($item >= 0 && $item < pow(10, 1) ? 'white' : ($item >= pow(10, 1) && $item <= 1.0 * pow(10, 1) - pow(10, 2) ? 'black' : 'white')) }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="rzw-box-content">
            <div class="card-body">
                <div class="container text-center">
                    <h3>EC</h3>
                </div>
                @php
                    $i = 1;
                @endphp
                @foreach (RZWHelper::FilterName($decode_qc, 'ec_input_') as $key => $item)
                    <div class="input-group my-3">
                        <input type="text" class="form-control rzw-input" name="{{ $key }}"
                            id="{{ $key }}" placeholder="Value {{ $i++ }}"
                            value="{{ $item }}"
                            style="background-color: {{ $item == null ? 'white' : ($item >= 0 && $item <= 1.0 ? 'green' : ($item >= 1.1 && $item <= 1.5 ? '#ecd700' : '#ff0000')) }}; color: {{ $item == null ? 'black' : ($item >= 0 && $item <= 1.0 ? 'white' : ($item >= 1.1 && $item <= 1.5 ? 'black' : 'white')) }};"
                            {{ $details->status == 0 && $details->user_id == Auth::user()->id && Auth::user()->role->name != 'viewers' ? '' : 'readonly' }}>
                        <div class="input-group-prepend">
                            <span class="rzw-icon-input" style="z-index: 5;">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                    viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                    stroke-linecap="round" stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M10 12h4" />
                                    <path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" />
                                    <path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" />
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        @if ($details->status == 0 && ($details->user_id == Auth::user()->id || Auth::user()->role->name == 'manager'))
            <div class="rzw-box-content">
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary w-100 rzw-btn-content">Simpan</button>
                    </div>
                </div>
            </div>
        @endif
    </form>

    @if ($details->status == 0 && Auth::user()->role->name == 'manager')
        <div class="rzw-box-content">
            <div class="row">
                <div class="col-6">
                    <a href="javascript:void(0)" class="btn btn-primary w-100 rzw-btn-content"
                        onclick="LoadingEvent('{{ url('/qc_air_baku/reject/' . $details->id) }}', 'Reject')"
                        style="background-color: red; border: none; border-radius: 8px; color: black; color: white;">
                        Reject
                    </a>
                </div>
                <div class="col-6">
                    <button class="btn btn-primary w-100" onclick="deleteData({{ $details->id }})"
                        style="background-color: #f3e100; border: none; border-radius: 8px; color: black;">Hapus</button>
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <a href="javascript:void(0)" class="btn btn-primary w-100 rzw-btn-content"
                        onclick="LoadingEvent('{{ url('/qc_air_baku/approve/' . $details->id) }}', 'Approve')"
                        style="background-color: green;">
                        Approve
                    </a>
                </div>
            </div>
        </div>
    @endif
@endsection


@section('js')
    <script>
        function deleteData(id) {
            Swal.fire({
                title: "Apakah Kamu Yakin?",
                text: "Data akan dihapus secara permanen!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Ya, Hapus Data!"
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = "{{ url('qc_air_baku/delete') }}" + "/" + id;
                }
            });
        }

        function loading(text) {
            Swal.fire({
                title: `${text}...`,
                html: `
                    <div class="custom-loader">
                        <div class="spinner"></div>
                    </div>
                `,
                showConfirmButton: false,
                allowOutsideClick: false,
                customClass: {
                    popup: 'custom-popup'
                }
            });
        }

        function LoadingEvent(exportUrl, text) {
            loading(text);
            window.location.href = exportUrl;
        }
    </script>
@endsection
