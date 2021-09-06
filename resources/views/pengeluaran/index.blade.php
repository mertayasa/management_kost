@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Jenis Pembayaran</h4>
            <a href="{{route('jenis_pembayaran.create')}}" class="btn btn-primary">Tambah Jenis Pembayaran</a>
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              {{-- @include('jenis_pembayaran.datatable') --}}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
