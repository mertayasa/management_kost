<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('jenisPengeluaran', 'Jenis Pengeluaran', ['class' => 'mb-1']) !!}
        @if (isset($pengeluaran))
            {!! Form::text('id_jenis_pengeluaran', $pengeluaran->jenis_pengeluaran->jenis_pengeluaran, ['class' => 'form-control', 'id' => 'jenisPengeluaran', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_jenis_pengeluaran', $jenis_pengeluaran, null, ['class' => 'form-control', 'id' => 'jenisPengeluaran']) !!}
        @endif
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('jumlah', 'Jumlah (Rp)', ['class' => 'mb-1']) !!}
        {!! Form::number('jumlah', null, ['class' => 'form-control', 'id' => 'jumlah']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('tglPengeluaran', 'Tanggal Pengeluaran', ['class' => 'mb-1']) !!}
        {!! Form::date('tgl_pengeluaran', null, ['class'=>'form-control', 'id' => 'tglPengeluaran']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('keterangan', 'Keterangan', ['class' => 'mb-1']) !!}
        {!! Form::textarea('keterangan', null, ['class' => 'form-control', 'id' => 'keterangan', 'style' => 'height:150px']) !!}
    </div>
</div>