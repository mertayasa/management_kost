<table class="table table-hover table-striped" width="100%" id="kamarDatatable">
    <thead>
        <tr>
        <th>No</th> <th></th>
        <th>Nama Kost</th>
        <th>No Kamar</th>
        <th>Harga</th>
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
    let url = "{{ route('kamar.datatable') }}"

    datatable(url)
    function datatable (url){

        let columns = [
            {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
            {data:'updated_at', name:'updated_at', visible:false, searchable:false},
            {data: 'nama_kost', name: 'nama_kost'},
            {data: 'no_kamar', name: 'no_kamar'},
            {data: 'harga', name: 'harga'},
        ]

        if(userRole == 'owner'){
            columns.push({data: 'action', name: 'action', orderable: false, searchable: false})
        }

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