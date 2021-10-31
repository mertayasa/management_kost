@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between">
                        <h4>{{ $kost->nama }}</h4>
                        @if (showFor(['owner']))
                          <a href="{{route('kamar.create', $kost->id)}}" class="btn btn-primary">Tambah Kamar</a>
                        @endif
                    </div>
                    <div class="col-6">
                        <div class="col-12 px-2 mt-3">
                            <h6>Alamat : {{ $kost->alamat }}</h6>
                            <hr>
                        </div>
                    </div>
                    <div class="col-12">
                        @include('layouts.flash')
                    </div>
                    <div class="card-body">
                        @include('kost.datatable_kamar')
                        <div class="row mt-3">
                            <div class="col-12">
                                <a href="{{ route('kost.index') }}" class="btn btn-secondary">Kembali</a>
                                {{-- <button class="btn btn-primary ml-3" type="submit">Simpan</button> --}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
