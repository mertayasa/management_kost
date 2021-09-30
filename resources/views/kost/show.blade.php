@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>{{$kost->nama}}</h4>
          </div>
          <div class="col-12">
              <div class="col-12 px-2 mt-3">
                  <h6>Alamat : {{$kost->alamat}}</h6>
                  <hr>
              </div>
              @include('layouts.flash')
          </div>
          <div class="card-body">
              @include('kost.datatable_kamar')
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
