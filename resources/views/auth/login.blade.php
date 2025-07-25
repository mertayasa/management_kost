@extends('layouts.auth.app')
@section('title', 'Login')
@section('content')
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6">
      {{-- <div class="login-brand">
        <img class="img-fluid" src="{{asset('images/logo.jpeg')}}" alt="Responsive image" width="150" height="150">
      </div> --}}

      <div class="card card-primary">
        <div class="card-body">
        <div class="alert alert-primary" role="alert">
                    <b>MANAGER</b> <br>
                    Email : manager@demo.com <br>
                    Password : asdasdasd
                  </div>
                  <div class="alert alert-success" role="alert">
                    <b>OWNER</b> <br>
                    Email : owner@demo.com <br>
                    Password : asdasdasd
                  </div>
                  <div class="alert alert-warning" role="alert">
                    <b>Pelanggan</b> <br>
                    Email : pegawai@demo.com <br>
                    Password : asdasdasd
                  </div>
                  
          <form method="POST" action="{{ route('login') }}" >
          @csrf

          <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
              @error('email')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <div class="d-block">
                  <label for="password" class="control-label">Password</label>
              </div>
              <input id="password" type="password" class="form-control" @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror

            </div>

            <div class="form-group">
              <div class="custom-control custom-checkbox">
                <input type="checkbox" name="remember"  id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label class="form-check-label" for="remember-me">Remember Me</label>
              </div>
            </div>

            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Login
              </button>
            </div>
          </form>
          {{-- <div class="text-center mt-4 mb-3">
              Belum punya akun? <a href="{{route('register')}}">Register Sekarang!</a>
          </div> --}}
        </div>
      </div>
    </div>
  </div>    
@endsection
