<table class="table table-hover table-striped" width="100%" id="jenisPemasukanDatatable">
    <thead>
        <tr>
        <th>No</th> <th></th>
        <th>Jenis Pemasukan</th>
        @if(showFor(['manager']))
            <th>Aksi</th>
        @endif
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let table
    let url = "{{ route('jenis_pemasukan.datatable') }}"

    datatable(url)
    function datatable (url){

        let columns = [
            {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},{data:'updated_at', name:'updated_at', visible:false, searchable:false},
            {data: 'jenis_pemasukan', name: 'jenis_pemasukan'},
        ]

        @if(showFor(['manager']))
            columns.push({data: 'action', name: 'action', orderable: false, searchable: false})
        @endif

        table = $('#jenisPemasukanDatatable').DataTable({
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