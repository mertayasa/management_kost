<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
  <title>@yield('title')</title>

  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- Template CSS -->
  <link rel="stylesheet" href="{{asset('stisla-assets/css/style.css')}}">
  <link rel="stylesheet" href="{{asset('stisla-assets/css/components.css')}}">
</head>

<body>
  <div id="app">
    <section class="section">
      <div class="container mt-5">
        @yield('content')
      </div>
    </section>
  </div>

  <script src="{{asset('js/app.js')}}"></script>
  <!-- General JS Scripts -->
  <script src="{{asset('stisla-assets/js/stisla.js')}}"></script>

  <!-- JS Libraies -->

  <!-- Template JS File -->
  <script src="{{asset('stisla-assets/js/scripts.js')}}"></script>
  <script src="{{asset('stisla-assets/js/custom.js')}}"></script>

  <!-- Page Specific JS File -->
</body>
</html>