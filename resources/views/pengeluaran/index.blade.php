@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Pengeluaran</h4>
            @if (showFor(['manager']))
              <a href="{{route('pengeluaran.create')}}" class="btn btn-primary">Tambah Pengeluaran</a>
            @endif
          </div>
          <div class="col-12">
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('pengeluaran.datatable')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
