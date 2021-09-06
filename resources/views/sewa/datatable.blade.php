<table class="table table-hover table-striped" width="100%" id="sewaDatatable">
    <thead>
        <tr>
        <th>No</th>
        <th>Nama Kost</th>
        <th>No Kamar</th>
        <th>Penyewa</th>
        <th>Tanggal Masuk</th>
        <th>Tanggal Keluar</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let table
    let url = "{{ route('sewa.datatable') }}"

    datatable(url)
    function datatable (url){

        table = $('#sewaDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [
                {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
                {data: 'nama_kost', name: 'nama_kost'},
                {data: 'no_kamar', name: 'no_kamar'},
                {data: 'penyewa', name: 'penyewa'},
                {data: 'tgl_masuk', name: 'tgl_masuk'},
                {data: 'tgl_keluar', name: 'tgl_keluar'},
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