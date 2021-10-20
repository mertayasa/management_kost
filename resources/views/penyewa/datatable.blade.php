<table class="table table-hover table-striped" width="100%" id="penyewaDatatable">
    <thead>
        <tr>
        <th>No</th> <th></th>
        <th>Nama</th>
        <th>No Telp</th>
        <th>No Ktp</th>
        <th>Validasi</th>
        <th>Status Sewa</th>
        @if (showFor(['pegawai', 'manager']))
            <th>Aksi</th>
        @endif
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let table
    @if(isset($status))
        let url = "{{ route('penyewa.datatable', $status) }}"
    @else
        let url = "{{ route('penyewa.datatable') }}"
    @endif

    datatable(url)
    function datatable (url){

        let columns = [
            {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
            {data:'updated_at', name:'updated_at', visible:false, searchable:false},
            {data: 'nama', name: 'nama'},
            {data: 'telpon', name: 'telpon'},
            {data: 'no_ktp', name: 'no_ktp'},
            {data: 'status_validasi', name: 'status_validasi'},
            {data: 'status', name: 'status'},
        ]

        @if(showFor(['manager', 'pegawai']))
            columns.push({data: 'action', name: 'action', orderable: false, searchable: false})
        @endif

        table = $('#penyewaDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
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