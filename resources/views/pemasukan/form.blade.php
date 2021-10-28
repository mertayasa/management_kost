<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('selectPenyewa', 'Nama Penyewa', ['class' => 'mb-1']) !!}
        @if (isset($pemasukan))
            {!! Form::text('id_penyewa', $pemasukan->penyewa->nama, ['class' => 'form-control', 'id' => 'kamarNumber', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_penyewa', $penyewa, null, ['class' => 'form-control', 'id' => 'selectPenyewa', 'onchange' => 'getNamaSewa(this.value)']) !!}
        @endif
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('selectSewa', 'Data Sewa', ['class' => 'mb-1']) !!}
        @if (isset($pemasukan))
            {!! Form::hidden('id_sewa', $pemasukan->sewa->id, ['class' => 'form-control', 'id' => 'selectKos']) !!}
            {!! Form::text('id_sewa_nama', $pemasukan->sewa->nama_sewa, ['class' => 'form-control', 'id' => 'selectKosNama', 'readonly' => true, 'disabled' => true]) !!}
        @else
            {!! Form::select('id_sewa', [], null, ['class' => 'form-control', 'id' => 'selectSewa']) !!}
        @endif

    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('jenisPemasukan', 'Jenis Pemasukan', ['class' => 'mb-1']) !!}
        {!! Form::select('id_jenis_pemasukan', $jenis_pemasukan, null, ['class' => 'form-control', 'id' => 'jenisPemasukan']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('jumlahPemasukan', 'Jumlah Pemasukan (Rp)', ['class' => 'mb-1']) !!}
        {!! Form::number('jumlah', null, ['class' => 'form-control', 'id' => 'jumlahPemasukan']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('tglPemasukan', 'Tanggal Pemasukan', ['class' => 'mb-1']) !!}
        {!! Form::date('tgl_pemasukan', isset($pemasukan) ? $pemasukan->tgl_pemasukan : date('Y-m-d'), ['class'=>'form-control', 'id' => 'tglPemasukan']) !!}
    </div>
</div>

@push('scripts')
    @if (Request::is('*create*'))
        <script>
            // const selectPenyewa = document.getElementById('selectPenyewa')
            // getNamaSewa(selectPenyewa.value)


            // function getNamaSewa(id_penyewa){
            //     const namaKamarKost = document.getElementById('namaKamarKost')

            //     const headers = new Headers({
            //         'Content-Type': 'x-www-form-urlencoded',
            //         'X-CSRF-TOKEN': "{{csrf_token()}}"
            //     });

            //     fetch("{{url('penyewa/get-nama-kamar')}}" + '/' + id_penyewa, {
            //         headers
            //     })
            //     .then(response => response.json())
            //     .then(data => {
            //         namaKamarKost.value = data.data
            //     });

            // }

            // const lastSelectedSewa = "{{$sewa->id_kamar ?? null}}"
            const selectPenyewa = document.getElementById('selectPenyewa')
            const selectSewa = document.getElementById('selectSewa')
            const lastSelectedSewa = "{{$pemasukan->id_sewa ?? null}}"

            getNamaSewa(selectPenyewa.value)

            function getNamaSewa(idPenyewa){
                selectSewa.length = 0
                $.ajax({
                    url : "{{url('penyewa/get-sewa')}}" + '/' + idPenyewa,
                    dataType : "Json",
                    data : {"_token": "{{ csrf_token() }}"},
                    method : "get",
                    success:function(data){
                        // console.log(data.sewa)
                        for (let index = 0; index < data.sewa.length; index++) {
                            selectSewa.insertAdjacentHTML('beforeend', `
                                <option value="${data.sewa[index].id}"} ${lastSelectedSewa == data.sewa[index].id ? 'selected' : ''}>${data.sewa[index].nama_sewa}</option>
                            `)
                                // <option value="${data.kamar[index].id}" ${lastSelectedSewa == data.kamar[index].id ? 'selected' : ''}>${data.kamar[index].no_kamar}</option>
                        }
                    }
                })
            }
        </script>
    @endif
@endpush