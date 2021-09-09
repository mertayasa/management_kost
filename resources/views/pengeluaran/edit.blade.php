@extends('layouts.app')

@section('content')
<section class="section">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header d-flex justify-content-between">
            <h4>Edit Pengeluaran</h4>
          </div>
          <div class="card-body">
            @include('layouts.flash')
            @include('layouts.error_message')
            {!! Form::model($pengeluaran, ['route' => ['pengeluaran.update', $pengeluaran->id], 'method' => 'patch']) !!}
            @include('pengeluaran.form')
            <div class="row mt-3">
                <div class="col-12">
                    <a href="{{$back_url}}" class="btn btn-secondary">Kembali</a>
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
