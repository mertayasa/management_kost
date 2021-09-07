<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('namaPenyewa', 'Nama', ['class' => 'mb-1']) !!}
        {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'namaPenyewa']) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('telponPenyewa', 'Telpon', ['class' => 'mb-1']) !!}
        {!! Form::text('telpon', null, ['class' => 'form-control', 'id' => 'telponPenyewa']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('noKtpPenyewa', 'No KTP', ['class' => 'mb-1']) !!}
        {!! Form::number('no_ktp', null, ['class' => 'form-control', 'id' => 'noKtpPenyewa']) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('pekerjaanPenyewa', 'Pekerjaan', ['class' => 'mb-1']) !!}
        {!! Form::text('pekerjaan', null, ['class' => 'form-control', 'id' => 'pekerjaanPenyewa']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('alamatPenyewa', 'Alamat', ['class' => 'mb-1']) !!}
        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'id' => 'alamatPenyewa', 'style' => 'height:150px']) !!}
    </div>
    {{-- <div class="col-12 col-md-6">
        <div class="form-group">
            <div class="control-label">Validasi</div>
            <label class="custom-switch mt-2 pl-0">
              <input type="checkbox" name="custom-switch-checkbox" class="custom-switch-input">
              <span class="custom-switch-indicator"></span>
              <span class="custom-switch-description">I agree with terms and conditions</span>
            </label>
          </div>
    </div> --}}
</div>