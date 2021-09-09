<table class="table table-hover table-striped" width="100%" id="pengeluaranDatatable">
    <thead>
        <tr>
        <th>No</th> <th></th>
        <th>Jenis</th>
        <th>Jumlah</th>
        <th>Tanggal</th>
        <th>Validasi</th>
        <th>Keterangan</th>
        <th>Aksi</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')
<script>

    let tablePengeluaran

    @if(isset($status))
        let urlPengeluaran = "{{ route('pengeluaran.datatable', $status) }}"
    @else
        let urlPengeluaran = "{{ route('pengeluaran.datatable') }}"
    @endif

    datatablePengeluaran(urlPengeluaran)
    function datatablePengeluaran (urlPengeluaran){

        tablePengeluaran = $('#pengeluaranDatatable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: urlPengeluaran,
            columns: [
                {data: 'DT_RowIndex', name: 'no',orderable: false, searchable: false},
                {data:'updated_at', name:'updated_at', visible:false, searchable:false},
                {data: 'id_jenis_pengeluaran', name: 'id_jenis_pengeluaran'},
                {data: 'jumlah', name: 'jumlah'},
                {data: 'tgl_pengeluaran', name: 'tgl_pengeluaran'},
                {data: 'status_validasi', name: 'status_validasi'},
                {data: 'keterangan', name: 'keterangan'},
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