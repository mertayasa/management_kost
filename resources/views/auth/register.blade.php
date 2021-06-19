@extends('layouts.auth.app')
@section('title', 'Register')
@section('content')
<div class="row">
    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-6 ">
      <div class="login-brand">
        {{-- <img src="../assets/img/stisla-fill.svg" alt="logo" width="100" class="shadow-light rounded-circle"> --}}
        <h1 style="color: #6777ef">Register</h1>
      </div>

      <div class="card card-primary">
        <div class="card-header"><h4>Register</h4></div>

        <div class="card-body">
          {{-- class="needs-validation" novalidate="" --}}
          <form method="POST" action="{{ route('register') }}">
          @csrf

          <div class="form-group">
              <label for="email">Nama</label>
              <input id="name" type="text" class="form-control" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
              @error('name')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input id="email" type="email" class="form-control" @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

              @error('email')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="d-block">
                  <label for="phone" class="control-label">No Telpon</label>
              </div>
              <input id="phone" type="number" class="form-control" @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="new-phone">
              @error('phone')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <div class="d-block">
                  <label for="address" class="control-label">Alamat</label>
              </div>
              <input id="address" type="text" class="form-control" @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="new-address">

              @error('address')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>

            <div class="form-group">
              <div class="d-block">
                  <label for="password" class="control-label">Password</label>
              </div>
              <input id="password" type="password" class="form-control" @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
              @error('password')
              <span class="invalid-feedback d-block" role="alert">
                  <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
            <div class="form-group">
              <div class="d-block">
                  <label for="password-confirm" class="control-label">Konfirmasi Password</label>
              </div>
              <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                Register
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div> 
@endsection