@extends('layouts.app')

@push('styles')
    <style>
        .filepond--root {
            margin-bottom: 0px !important;
        }

        @media (min-width: 768px) and (max-width: 991.98px) {
            .filepond--item {
                width: calc(50% - 0.5em);
            }
        }

        @media (min-width: 992px) {
            .filepond--item {
                width: calc(33.33% - 0.5em);
            }
        }

    </style>
@endpush

@section('content')
    <section class="section">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-wallet"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pemasukan {{userRole() == 'manager' ? 'Bulan ini' : (userRole() == 'pegawai' ? 'Hari ini' : '')}} <small class="text-danger"> (Tervalidasi) </small></h4>
                        </div>
                        <div class="card-body">
                            {{ formatPrice($dashboard_data['total_pemasukan']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-file-invoice-dollar"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pengeluaran {{userRole() == 'manager' ? 'Bulan ini' : (userRole() == 'pegawai' ? 'Hari ini' : '')}} <small class="text-danger"> (Tervalidasi) </small></h4>
                        </div>
                        <div class="card-body">
                            {{ formatPrice($dashboard_data['total_pengeluaran']) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-piggy-bank"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Profit {{userRole() == 'manager' ? 'Bulan ini' : (userRole() == 'pegawai' ? 'Hari ini' : '')}}</h4>
                        </div>
                        <div class="card-body">
                            <span class=" {{ $dashboard_data['total_profit'] < 1 ? 'text-danger' : 'text-success' }} " > {{ formatPrice($dashboard_data['total_profit']) }} </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-check"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kamar Berpenghuni</h4>
                        </div>
                        <div class="card-body">
                            {{ $dashboard_data['kamar_isi'] }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-statistic-2">
                    <div class="card-icon shadow-primary bg-primary">
                        <i class="fas fa-times"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Kamar Kosong</h4>
                        </div>
                        <div class="card-body">
                            {{ $dashboard_data['kamar_kosong'] }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (userRole() == 'owner')
            @include('dashboard.chart')
        @endif

    </section>
@endsection

@push('scripts')

@endpush
