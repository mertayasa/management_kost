<div class="row mb-4">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('selectKos', 'Kos', ['class' => 'mb-1']) !!}
        @if (isset($sewa))
            {!! Form::hidden('id_kost', $sewa->kamar->kost->id, ['class' => 'form-control', 'id' => 'selectKos']) !!}
            {!! Form::text('id_kost_nama', $sewa->kamar->kost->nama, ['class' => 'form-control', 'id' => 'selectKosNama', 'readonly' => true, 'disabled' => true]) !!}
        @else
            {!! Form::select('id_kost', $kost, null, ['class' => 'form-control', 'id' => 'selectKos', 'onchange' => 'getKamar(this.value)']) !!}
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
            {!! Form::hidden('id_penyewa', $sewa->penyewa->id, ['class' => 'form-control', 'id' => 'penyewa', 'readonly' => true]) !!}
            {!! Form::text('id_penyewa_nama', $sewa->penyewa->nama, ['class' => 'form-control', 'id' => 'penyewa', 'readonly' => true, 'disabled' => true]) !!}
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

@push('scripts')
    <script>
        const lastSelectedKamar = "{{$sewa->id_kamar ?? null}}"
        const selectKost = document.getElementById('selectKos')
        const selectKamar = document.getElementById('selectkamar')
        getKamar(selectKost.value)

        function getKamar(idKost){
            selectKamar.length = 0
            $.ajax({
                url : "{{url('kost/kamar')}}" + '/' + idKost,
                dataType : "Json",
                data : {"_token": "{{ csrf_token() }}"},
                method : "get",
                success:function(data){
                    for (index = 0; index < data.kamar.length; index++) {
                        selectKamar.insertAdjacentHTML('beforeend', `
                            <option value="${data.kamar[index].id}" ${lastSelectedKamar == data.kamar[index].id ? 'selected' : ''}>${data.kamar[index].no_kamar}</option>
                        `)
                            // <option value="${data.kamar[index].id}" ${lastSelectedDistrict == district[dis].id ? 'selected' : ''}>${district[dis].name}</option>
                    }
                }
            })
        }
    </script>
@endpush