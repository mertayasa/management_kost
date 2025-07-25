<table class="table table-hover table-striped" width="100%" id="kamarDatatable">
    <thead>
        <tr>
        <th>No</th> <th></th>
        <th>Nama Kos</th>
        <th>Nomor Kamar</th>
        <th>Harga</th>
        <th>Ketersediaan Hari Ini</th>
        @if (userRole() == 'owner')
            <th>Aksi</th>
        @endif
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let table
    let url = "{{ $url_datatable }}"

    let columns = [
        {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
        {data:'updated_at', name:'updated_at', visible:false, searchable:false},
        {data: 'nama_kost', name: 'nama_kost'},
        {data: 'no_kamar', name: 'no_kamar'},
        {data: 'harga', name: 'harga'},
        {data: 'status', name: 'status'},
    ]

    if(userRole == 'owner'){
        columns.push({data: 'action', name: 'action', orderable: false, searchable: false})
    }

    datatable(url)
    function datatable (url){

        table = $('#kamarDatatable').DataTable({
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