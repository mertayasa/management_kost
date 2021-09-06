<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('kostName', 'Nama Kost', ['class' => 'mb-1']) !!}
        @if (isset($kamar))
            {!! Form::text('id_kost', $kamar->kost->nama, ['class' => 'form-control', 'id' => 'kamarNumber', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_kost', $kost, null, ['class' => 'form-control', 'id' => 'kostName']) !!}
        @endif
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('kamarNumber', 'No Kamar', ['class' => 'mb-1']) !!}
        {!! Form::text('no_kamar', null, ['class' => 'form-control', 'id' => 'kamarNumber']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('kamarPrice', 'Harga', ['class' => 'mb-1']) !!}
        {!! Form::number('harga', null, ['class' => 'form-control', 'id' => 'kamarPrice']) !!}
    </div>
</div>