@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Penyewaan</h4>
            {{-- @if (showFor(['pegawai']))
              <a href="{{route('sewa.create')}}" class="btn btn-primary">Tambah Data</a>
            @endif --}}
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('sewa.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
