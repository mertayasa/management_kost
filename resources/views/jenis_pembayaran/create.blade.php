@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Tambah Jenis Pemasukan</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::open(['route' => 'jenis_pembayaran.store']) !!}
            @include('jenis_pembayaran.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('jenis_pembayaran.index')}}" class="btn btn-secondary">Kembali</a>
                    <button class="btn btn-primary ml-3" type="submit">Simpan</button>
                </div>
            </div>
            {!! Form::close() !!}
          </div>
        </div>
      </div>
    </div>
  </section>
@endsection
