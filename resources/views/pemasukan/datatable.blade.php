<table class="table table-hover table-striped" width="100%" id="pemasukanDatatable">
    <thead>
        <tr>
        <th>No</th>
        <th></th>
        <th>Jenis</th>
        <th>Penyewa</th>
        <th>Kamar</th>
        <th>Nominal</th>
        <th>Tgl Pemasukan</th>
        <th>Validasi</th>
        @if(showFor(['pegawai']))
            <th>Aksi</th>
        @endif
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let pemasukanTable

    @if(isset($status))
        let urlPemasukan = "{{ route('pemasukan.datatable', $status) }}"
    @else
        let urlPemasukan = "{{ route('pemasukan.datatable') }}"
    @endif

    datatablePemasukan(urlPemasukan)
    function datatablePemasukan (urlPemasukan){

        let columns = [
            {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
            {data:'updated_at', name:'updated_at', visible:false, searchable:false},
            {data: 'id_jenis_pemasukan', name: 'id_jenis_pemasukan'},
            {data: 'id_penyewa', name: 'id_penyewa'},
            {data: 'id_kamar', name: 'id_kamar'},
            {data: 'jumlah', name: 'jumlah'},
            {data: 'tgl_pemasukan', name: 'tgl_pemasukan'},
            {data: 'status_validasi', name: 'status_validasi'},
        ]

        @if(showFor(['pegawai']))
            columns.push({data: 'action', name: 'action', orderable: false, searchable: false})
        @endif

        pemasukanTable = $('#pemasukanDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: urlPemasukan,
            columns: columns,
            order: [[ 1, "desc" ]],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets:  '_all',
                    className: 'align-middle'
                },
                { 
                    responsivePriority: 1, targets: 1
                },
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari"
            },
        });
    }

</script>

@endpush