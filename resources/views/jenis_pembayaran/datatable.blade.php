<table class="table table-hover table-striped" width="100%" id="jenisPembayaranDatatable">
    <thead>
        <tr>
        <th>No</th> <th></th>
        <th>Jenis Pemasukan</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let table
    let url = "{{ route('jenis_pembayaran.datatable') }}"

    datatable(url)
    function datatable (url){

        table = $('#jenisPembayaranDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [
{data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},{data:'updated_at', name:'updated_at', visible:false, searchable:false},
                {data: 'jenis_pembayaran', name: 'jenis_pembayaran'},
                {data: 'action', name: 'action', orderable: false, searchable: false}
            ],
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