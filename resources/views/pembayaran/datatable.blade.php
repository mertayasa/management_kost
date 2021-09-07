<table class="table table-hover table-striped" width="100%" id="pembayaranDatatable">
    <thead>
        <tr>
        <th>No</th>
        <th></th>
        <th>Jenis</th>
        <th>Penyewa</th>
        <th>Kamar</th>
        <th>Nominal</th>
        <th>Tgl Pembayaran</th>
        <th>Validasi</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let table
    let url = "{{ route('pembayaran.datatable') }}"

    datatable(url)
    function datatable (url){

        table = $('#pembayaranDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [
                {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
                {data:'updated_at', name:'updated_at', visible:false, searchable:false},
                {data: 'id_jenis_pembayaran', name: 'id_jenis_pembayaran'},
                {data: 'id_penyewa', name: 'id_penyewa'},
                {data: 'id_kamar', name: 'id_kamar'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'tgl_pembayaran', name: 'tgl_pembayaran'},
                {data: 'status_validasi', name: 'status_validasi'},
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