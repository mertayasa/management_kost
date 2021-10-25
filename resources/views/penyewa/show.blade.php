@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Penyewa</h4>
          </div>
          <div class="card-body">
              @include('penyewa.show_table')
              <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('penyewa.index')}}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
