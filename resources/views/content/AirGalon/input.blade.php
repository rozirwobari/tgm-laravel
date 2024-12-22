@php
    use App\Helpers\RZWHelper;
@endphp
@extends('layout')

@section('content')
<div class="rzw-container" style="display: flex;">
    <div class="rzw-box-content" style="flex: 0 0 15%; padding: 1px; border-radius: 10px 0 0 10px;">
        <a href="<?= url('/qc_air_galon') ?>">
            <h5 style="font-weight: 600; padding-top: 0.9vh;">
                <svg  xmlns="http://www.w3.org/2000/svg"  width="22"  height="22"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-chevron-left"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M15 6l-6 6l6 6" /></svg>
            </h5>
        </a>
    </div>
    <div class="rzw-box-content" style="flex: 0 0 85%; padding: 1px; border-radius: 0 10px 10px 0;">
        <h5 class="pt-2" style="font-weight: 600;">QC Air Galon</h5>
    </div>
</div>


<form action="<?= url('/qc_air_galon/input') ?>" method="post">
    @csrf
    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>Shift</h3>
            </div>
            <div class="input-group my-3">
                <select class="form-control rzw-input @error('shift') is-invalid @enderror"
                    name="shift" id="shift">
                    <option value="">Pilih Shift</option>
                    <option value="Sumber 1" <?= old('shift') == 'Sumber 1' ? 'selected' : '' ?> >Sumber 1</option>
                    <option value="Sumber 2" <?= old('shift') == 'Sumber 2' ? 'selected' : '' ?> >Sumber 2</option>
                    <option value="Sumber 3" <?= old('shift') == 'Sumber 3' ? 'selected' : '' ?> >Sumber 3</option>
                    <option value="Tangki" <?= old('shift') == 'Tangki' ? 'selected' : '' ?> >Tangki</option>
                    <option value="WT" <?= old('shift') == 'WT' ? 'selected' : '' ?> >WT</option>
                </select>
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
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
        <p class="p-2" style="font-weight: 600;">Fisiko Kimia</p>
    </div>
    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>TDS</h3>
            </div>
            <?php
                for ($i=1; $i <= 5; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="tds_input_<?= $i ?>" id="tds_input_<?= $i ?>" placeholder="Value <?= $i ?>"
                    value="<?= old('tds_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>PH</h3>
            </div>
            <?php
                for ($i=1; $i <= 5; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="ph_input_<?= $i ?>" id="ph_input_<?= $i ?>" placeholder="Value <?= $i ?>"
                    value="<?= old('ph_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>KERUHAN</h3>
            </div>
            <?php
                for ($i=1; $i <= 5; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="keruhan_input_<?= $i ?>" id="keruhan_input_<?= $i ?>" placeholder="Value <?= $i ?>"
                    value="<?= old('keruhan_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>


    <div class="rzw-box-content" style="padding: 0px; margin-top: 4vh;">
        <p class="p-2" style="font-weight: 600;">Organoleptik</p>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>RASA</h3>
            </div>
            <?php
                for ($i=1; $i <= 5; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="rasa_input_<?= $i ?>" id="rasa_input_<?= $i ?>" placeholder="Value <?= $i ?>" value="<?= old('rasa_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>AROMA</h3>
            </div>
            <?php
                for ($i=1; $i <= 5; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="aroma_input_<?= $i ?>" id="aroma_input_<?= $i ?>" placeholder="Value <?= $i ?>" value="<?= old('aroma_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>WARNA (Visual)</h3>
            </div>
            <?php
                for ($i=1; $i <= 5; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="warna_input_<?= $i ?>" id="warna_input_<?= $i ?>" placeholder="Value <?= $i ?>" value="<?= old('warna_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content" style="padding: 0px; margin-top: 4vh;">
        <p class="p-2" style="font-weight: 600;">Mikrobiologi</p>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>ALT</h3>
            </div>
            <?php
                for ($i=1; $i <= 3; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="alt_input_<?= $i ?>" id="alt_input_<?= $i ?>" placeholder="Value <?= $i ?>"
                    value="<?= old('alt_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                    <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content">
        <div class="card-body">
            <div class="container text-center">
                <h3>EC</h3>
            </div>
            <?php
                for ($i=1; $i <= 2; $i++) { 
            ?>
            <div class="input-group my-3">
                <input type="text" class="form-control rzw-input"
                    name="ec_input_<?= $i ?>" id="ec_input_<?= $i ?>" placeholder="Value <?= $i ?>"
                    value="<?= old('ec_input_'.$i) ?>">
                <div class="input-group-prepend">
                    <span class="rzw-icon-input" style="z-index: 5;">
                        <svg  xmlns="http://www.w3.org/2000/svg"  width="24"  height="24"  viewBox="0 0 24 24"  fill="none"  stroke="currentColor"  stroke-width="2"  stroke-linecap="round"  stroke-linejoin="round"  class="icon icon-tabler icons-tabler-outline icon-tabler-cursor-text"><path stroke="none" d="M0 0h24v24H0z" fill="none"/><path d="M10 12h4" /><path d="M9 4a3 3 0 0 1 3 3v10a3 3 0 0 1 -3 3" /><path d="M15 4a3 3 0 0 0 -3 3v10a3 3 0 0 0 3 3" /></svg>
                    </span>
                </div>
            </div>
            <?php
                }
            ?>
        </div>
    </div>

    <div class="rzw-box-content">
        <button type="submit" class="btn btn-primary w-100"
            style="background-color: #00b4cd; border: none; border-radius: 8px;">Submit</button>
    </div>
</form>
@endsection
