@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Kost</h4>
            @if (userRole() != 'pegawai')
              <a href="{{route('kost.create')}}" class="btn btn-primary">Tambah Kost</a>
            @endif
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('kost.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
