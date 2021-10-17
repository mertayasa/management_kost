@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Jenis Pemasukan</h4>
            @if (userRole() == 'manager')
              <a href="{{route('jenis_pemasukan.create')}}" class="btn btn-primary">Tambah Jenis Pemasukan</a>
            @endif
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('jenis_pemasukan.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
