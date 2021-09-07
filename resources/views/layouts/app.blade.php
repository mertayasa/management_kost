<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>Management Kost</title>

  <!-- Template CSS -->
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('stisla-assets/css/components.css')}}">
  <link rel="stylesheet" href="{{asset('stisla-assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('plugin/datatables/datatables.css')}}">
  @stack('styles')
</head>

<body>
  <div id="app">
    <div class="main-wrapper">
      <div class="navbar-bg"></div>

      @include('layouts.navbar')
      
	  <div class="main-sidebar">
		  @include('layouts.sidebar')
      </div>

      <!-- Main Content -->
      <div class="main-content">
        @yield('content')
      </div>
      <footer class="main-footer">
        <div class="footer-left">
          {{-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> --}}
        </div>
        <div class="footer-right">
          2.3.0
        </div>
      </footer>
    </div>
  </div>

  {{-- <div id="preloader"></div> --}}

  <script src="{{asset('js/app.js')}}" ></script>
  <script src="{{asset('plugin/datatables/datatables.js')}}" ></script>

  <script>
    // const preloader = document.getElementById('preloader')
    // preloader.classList.remove('d-none-custom')

    // setTimeout(function() {
    //     preloader.classList.add('d-none-custom')
    // }, 500);

    function showToast(code, text){
      if(code == 1){
        toastr.success(text)
      }

      if(code == 0){
        toastr.error(text)
      }
    }

    function deleteModel(deleteUrl, tableId, target = ''){
        Swal.fire({
            title: "Warning",
            text: `Yakin menghapus data ${target}? Proses ini tidak dapat diulang`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#169b6b',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya',
            cancelButtonText: 'Tidak'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url : deleteUrl,
                    dataType : "Json",
                    data : {"_token": "{{ csrf_token() }}"},
                    method : "delete",
                    success:function(data){
                        console.log(data)
                        if(data.code == 1){
                          showToast(data.code, data.message)
                        }else{
                            showToast(data.code, data.message)
                        }
                        $('#'+tableId).DataTable().ajax.reload();
                    }
                })
            }
        })
      }

    $(document).ready(function() {
        $('select').select2();
    })
      
  </script>

  <!-- Page Specific JS File -->
  {{-- <script src="{{asset('admin/js/page/index.js')}}"></script> --}}
  @stack('scripts')
</body>
</html>