@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Kamar</h4>
            {{-- <a href="{{route('employee.create')}}" class="btn btn-primary">Tambah Karyawan</a> --}}
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::model($kamar, ['route' => ['kamar.update', $kamar->id], 'method' => 'patch']) !!}
            @include('kamar.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{route('kamar.index')}}" class="btn btn-secondary">Kembali</a>
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
