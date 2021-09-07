<div class="row mb-4">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('penyewa', 'Nomor Kamar', ['class' => 'mb-1']) !!}
        @if (isset($sewa))
            {!! Form::text('id_kamar', $sewa->kamar->no_kamar, ['class' => 'form-control', 'id' => 'nomorKamar', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_kamar', $kamar, null, ['class' => 'form-control', 'id' => 'nomorKamar']) !!}
            <span class="text-danger"> {{$kamar_full}} </span>
        @endif
        

        <div class="penyewa mt-3">
            {!! Form::label('penyewa', 'Penyewa', ['class' => 'mb-1']) !!}
            @if (isset($sewa))
                {!! Form::text('id_penyewa', $sewa->penyewa->nama, ['class' => 'form-control', 'id' => 'penyewa', 'readonly' => true]) !!}
            @else
                {!! Form::select('id_penyewa', $penyewa, null, ['class' => 'form-control', 'id' => 'penyewa']) !!}
                <span class="text-danger"> {{$penyewa_full}} </span>
            @endif
    
        </div>
    </div>

    <div class="col-12 col-md-6">
        {!! Form::label('tglMasuk', 'Tanggal Masuk', ['class' => 'mb-1']) !!}
        {!! Form::date('tgl_masuk', null, ['class'=>'form-control', 'id' => 'tglMasuk']) !!}

        {{-- {!! Form::label('tglKeluar', 'Tanggal Keluar', ['class' => 'mb-1 mt-3']) !!}
        {!! Form::date('tgl_keluar', null, ['class'=>'form-control', 'id' => 'tglKeluar']) !!} --}}
    </div>
</div>