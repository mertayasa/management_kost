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
            {!! Form::select('id_sewa', [], null, ['class' => 'form-control', 'id' => 'selectSewa', 'onchange' => 'checkJenis()']) !!}
        @endif

    </div>
</div>

<div class="row mt-3">
    <div class="col-12 col-md-6">
        {!! Form::label('jenisPemasukan', 'Jenis Pemasukan', ['class' => 'mb-1']) !!}
        {!! Form::select('id_jenis_pemasukan', $jenis_pemasukan, null, ['class' => 'form-control', 'id' => 'jenisPemasukan', 'onchange' => Request::is('*create*') ? 'checkJenis()' : '']) !!}
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
            const selectPenyewa = document.getElementById('selectPenyewa')
            const selectSewa = document.getElementById('selectSewa')
            const lastSelectedSewa = "{{$pemasukan->id_sewa ?? null}}"
            const jumlahPemasukan = document.getElementById('jumlahPemasukan')
            const jenisPemasukan = document.getElementById('jenisPemasukan')

            getNamaSewa(selectPenyewa.value)

            function getNamaSewa(idPenyewa){
                selectSewa.length = 0
                $.ajax({
                    url : "{{url('penyewa/get-sewa')}}" + '/' + idPenyewa,
                    dataType : "Json",
                    data : {"_token": "{{ csrf_token() }}"},
                    method : "get",
                    success:function(data){
                        for (let index = 0; index < data.sewa.length; index++) {
                            selectSewa.insertAdjacentHTML('beforeend', `
                                <option value="${data.sewa[index].id}" ${lastSelectedSewa == data.sewa[index].id ? 'selected' : ''}>${data.sewa[index].nama_sewa}</option>
                            `)
                        }

                        // if(data.sewa[0] == undefined){
                        //     return getSelectedSewa()
                        // }

                        return checkJenis()

                        // return getSelectedSewa(data.sewa[0].id)

                    }
                })
            }

            function checkJenis(){
                const jenis = jenisPemasukan.options[jenisPemasukan.selectedIndex].text
                if(jenis.toLowerCase() == 'kamar'){
                    return getSelectedSewa()
                }

                return jumlahPemasukan.value = ''
            }

            function getSelectedSewa(){
                const idSewa = selectSewa.options[selectSewa.selectedIndex].value

                $.ajax({
                    url : "{{url('sewa/get-sewa-price')}}" + '/' + idSewa,
                    dataType : "Json",
                    data : {"_token": "{{ csrf_token() }}"},
                    method : "get",
                    success:function(data){
                        return jumlahPemasukan.value = data.price
                    }
                })
            }

            
        </script>
    @endif
@endpush