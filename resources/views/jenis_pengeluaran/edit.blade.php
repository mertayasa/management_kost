@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Jenis Pengeluaran</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::model($jenis_pengeluaran, ['route' => ['jenis_pengeluaran.update', $jenis_pengeluaran->id], 'method' => 'patch']) !!}
            @include('jenis_pengeluaran.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('jenis_pengeluaran.index')}}" class="btn btn-secondary">Kembali</a>
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
