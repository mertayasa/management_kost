@push('scripts')
  <script>
    $(document).ready(function() {
      $('a[data-toggle="tab"]').on( 'shown.bs.tab', function (e) {
          $.fn.dataTable.tables( {visible: true, api: true} ).columns.adjust().responsive.recalc();
      });
    })
  </script>
@endpush