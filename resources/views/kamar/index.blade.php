@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Kamar</h4>
            @if (userRole() != 'pegawai')
              <a href="{{route('kamar.create')}}" class="btn btn-primary">Tambah Kamar</a>
            @endif
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('kamar.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
