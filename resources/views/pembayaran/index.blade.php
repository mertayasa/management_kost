@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Pembayaran</h4>
            <a href="{{route('pembayaran.create')}}" class="btn btn-primary">Tambah Pembayaran</a>
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('pembayaran.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
