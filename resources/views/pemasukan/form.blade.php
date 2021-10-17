<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('namaPenyewa', 'Nama Penyewa', ['class' => 'mb-1']) !!}
        @if (isset($pemasukan))
            {!! Form::text('id_penyewa', $pemasukan->penyewa->nama, ['class' => 'form-control', 'id' => 'kamarNumber', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_penyewa', $penyewa, null, ['class' => 'form-control', 'id' => 'namaPenyewa', 'onchange' => 'getNamaKost(this.value)']) !!}
        @endif
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('namaKamarKost', 'Kost, Kamar', ['class' => 'mb-1']) !!}
        {!! Form::text('kamar_kost', isset($pemasukan) ? $pemasukan->nama_kost : null, ['class' => 'form-control', 'id' => 'namaKamarKost', 'readonly']) !!}
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
            const namaPenyewa = document.getElementById('namaPenyewa')
            getNamaKost(namaPenyewa.value)


            function getNamaKost(id_penyewa){
                const namaKamarKost = document.getElementById('namaKamarKost')

                const headers = new Headers({
                    'Content-Type': 'x-www-form-urlencoded',
                    'X-CSRF-TOKEN': "{{csrf_token()}}"
                });

                fetch("{{url('penyewa/get-nama-kamar')}}" + '/' + id_penyewa, {
                    headers
                })
                .then(response => response.json())
                .then(data => {
                    namaKamarKost.value = data.data
                });

            }
        </script>
    @endif
@endpush