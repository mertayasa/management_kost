<div class="row">
    <div class="col-12 col-md-6 pb-3 pb-md-0">
        {!! Form::label('namaPenyewa', 'Nama Penyewa', ['class' => 'mb-1']) !!}
        @if (isset($pembayaran))
            {!! Form::text('id_penyewa', $pembayaran->penyewa->nama, ['class' => 'form-control', 'id' => 'kamarNumber', 'readonly' => true]) !!}
        @else
            {!! Form::select('id_penyewa', $penyewa, null, ['class' => 'form-control', 'id' => 'namaPenyewa', 'onchange' => 'getNamaKost(this.value)']) !!}
        @endif
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('namaKamarKost', 'Kost, Kamar', ['class' => 'mb-1']) !!}
        {!! Form::text('kamar_kost', isset($pembayaran) ? $pembayaran->nama_kost : null, ['class' => 'form-control', 'id' => 'namaKamarKost', 'readonly']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('jenisPembayaran', 'Jenis Pemasukan', ['class' => 'mb-1']) !!}
        {!! Form::select('id_jenis_pembayaran', $jenis_pembayaran, null, ['class' => 'form-control', 'id' => 'jenisPembayaran']) !!}
    </div>
    <div class="col-12 col-md-6">
        {!! Form::label('jumlahPembayaran', 'Jumlah Pembayaran (Rp)', ['class' => 'mb-1']) !!}
        {!! Form::number('jumlah', null, ['class' => 'form-control', 'id' => 'jumlahPembayaran']) !!}
    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('tglPembayaran', 'Tanggal Pembayaran', ['class' => 'mb-1']) !!}
        {!! Form::date('tgl_pembayaran', isset($pembayaran) ? $pembayaran->tgl_pembayaran : date('Y-m-d'), ['class'=>'form-control', 'id' => 'tglPembayaran']) !!}
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