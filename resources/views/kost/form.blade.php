<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('kostName', 'Nama Kost', ['class' => 'mb-1']) !!}
        {!! Form::text('nama', null, ['class' => 'form-control', 'id' => 'kostName']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('kostRoomCount', 'Jumlah Kamar', ['class' => 'mb-1']) !!}
        {!! Form::number('jumlah_kamar', isset($kost) ? $kost->jumlah_kamar : 0, ['class' => 'form-control', 'id' => 'kostRoomCount', 'disabled' => true]) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('kostAddress', 'Alamat Kost', ['class' => 'mb-1']) !!}
        {!! Form::textarea('alamat', null, ['class' => 'form-control', 'id' => 'kostAddress', 'style' => 'height:150px']) !!}
    </div>
</div>