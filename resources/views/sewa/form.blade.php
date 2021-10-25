<div class="row mb-4">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('selectKos', 'Kos', ['class' => 'mb-1']) !!}
        @if (isset($sewa))
            {!! Form::text('id_kost', $sewa->kamar->kost->id, ['class' => 'form-control', 'id' => 'selectKos', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_kost', $kost, null, ['class' => 'form-control', 'id' => 'selectKos']) !!}
        @endif
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('selectkamar', 'Kamar', ['class' => 'mb-1']) !!}
        {!! Form::select('id_kamar', [], null, ['class' => 'form-control', 'id' => 'selectkamar']) !!}
    </div>
</div>

<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('penyewa', 'Penyewa', ['class' => 'mb-1']) !!}
        @if (isset($sewa))
            {!! Form::text('id_penyewa', $sewa->penyewa->nama, ['class' => 'form-control', 'id' => 'penyewa', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_penyewa', ['Pilih Penyewa' => $penyewa], 0, ['class' => 'form-control', 'id' => 'penyewa']) !!}
        @endif
    </div>
</div>

<hr>

<div class="row mb-4">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('tglMasuk', 'Tanggal Masuk', ['class' => 'mb-1']) !!}
        {!! Form::date('tgl_masuk', null, ['class'=>'form-control', 'id' => 'tglMasuk', Request::is('*keluar*') ? 'readonly' : '']) !!}
    </div>
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('tglKeluar', 'Tanggal Keluar', ['class' => 'mb-1']) !!}
        {!! Form::date('tgl_keluar', null, ['class'=>'form-control', 'id' => 'tglKeluar']) !!}
    </div>
</div>