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
                        <i class="fas fa-archive"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pemasukan <small class="text-danger"> (Tervalidasi) </small></h4>
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
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Pemasukan <small class="text-danger"> (Tervalidasi) </small></h4>
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
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Profit</h4>
                        </div>
                        <div class="card-body">
                            {{ formatPrice($dashboard_data['total_profit']) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        @if (userRole() == 'owner')
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Profit</h4>
                            <div class="card-header-action">
                                <div class="card-stats-title">
                                    <div class="dropdown d-inline">
                                        <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            href="#" id="orders-month">Pilih Tahun</a>
                                        <ul class="dropdown-menu dropdown-menu-sm">
                                            @foreach ($dashboard_data['tahun_pemasukan'] as $year)
                                                <li><a href="javascript:void(0)" class="dropdown-item"
                                                        onclick="generateProfitData('{{ $year }}')">{{ $year }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="profitChart" height="70"></canvas>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Grafik Pemasukan Dan Pengeluaran</h4>
                            <div class="card-header-action">
                                <div class="card-stats-title">
                                    <div class="dropdown d-inline">
                                        <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown"
                                            href="#" id="orders-month">Pilih Tahun</a>
                                        <ul class="dropdown-menu dropdown-menu-sm">
                                            @foreach ($dashboard_data['tahun_pemasukan'] as $year)
                                                <li><a href="javascript:void(0)" class="dropdown-item"
                                                        onclick="generateInOutData('{{ $year }}')">{{ $year }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <canvas id="incomeAndExpenseChart" height="70"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </section>
@endsection

@push('scripts')

@if (userRole() == 'owner')
    <script>
		let chart
		const labels = ["Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"]

        generateInOutData()

        function generateInOutData(year = null) {
            const url = "{{ route('dashboard.chart_in_out') }}"
            let formData = year == null ? {
                year: 'now'
            } : {
                year: year
            }

            // const incomeSelectedYear = document.getElementById('incomeSelectedYear')

            // if(year != null){
            //   incomeSelectedYear.innerHTML = year
            // }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
					console.log(data)
                    if (data.code === 1) {
                        if (year != null) {
                            chart.destroy()
                            chart = generateInOutChart(data)
                        } else {
                            chart = generateInOutChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function generateInOutChart(data) {
            const chartInOutElement = document.getElementById("incomeAndExpenseChart").getContext('2d')

            const dataInOut = {
                labels: labels,
                datasets: [{
                    label: 'Pengeluaran',
                    data: data.pengeluaran,
                    borderColor: 'rgb(244,174,194)',
                    backgroundColor: 'rgb(244,174,194)',
                }, {
                    label: 'Pemasukan',
                    data: data.pemasukan,
                    borderColor: 'rgb(145,208,246)',
                    backgroundColor: 'rgb(145,208,246)',
                }]
            }

            const optionsInOut = {
                legend: {
                    display: false
                },
                elements: {
                    line: {
                        lineTension: 0
                    }
                },
                scales: {
                    yAxes: [{
                        gridLines: {
                            // display: false,
                            drawBorder: false,
                            color: '#f2f2f2',
                        },
                        ticks: {
                            beginAtZero: true,
                            stepSize: 1500,
                            callback: function(value, index, values) {
                                return 'Rp' + value;
                            }
                        }
                    }],
                    xAxes: [{
                        gridLines: {
                            display: false,
                            tickMarkLength: 15,
                        }
                    }]
                }
            }

            var chartInOut = new Chart(chartInOutElement, {
                type: 'bar',
                data: dataInOut,
                options: optionsInOut
            });

            return chartInOut
        }
    </script>

    <script>

		let profit
		generateProfitData()

		function generateProfitData(year = null) {
            const url = "{{ route('dashboard.chart_in_out', 'profit') }}"
            let formData = year == null ? {
                year: 'now'
            } : {
                year: year
            }

            // const incomeSelectedYear = document.getElementById('incomeSelectedYear')

            // if(year != null){
            //   incomeSelectedYear.innerHTML = year
            // }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
					console.log(data)
                    if (data.code === 1) {
                        if (year != null) {
                            profit.destroy()
                            profit = generateProfitChart(data)
                        } else {
                            profit = generateProfitChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

		function generateProfitChart(data){
			const profitChartCanvas = document.getElementById("profitChart").getContext('2d')

			const dataProfit = {
				labels: labels,
				datasets: [{
					label: 'Profit',
					data: data.profit,
					borderColor: 'rgb(145,208,246)',
					backgroundColor: 'rgb(145,208,246)',
				}]
			}

			const optionsProfit = {
				legend: {
					display: false
				},
				elements: {
					line: {
						lineTension: 0
					}
				},
				scales: {
					yAxes: [{
						gridLines: {
							// display: false,
							drawBorder: false,
							color: '#f2f2f2',
						},
						ticks: {
							beginAtZero: true,
							stepSize: 1500,
							callback: function(value, index, values) {
								return 'Rp' + value;
							}
						}
					}],
					xAxes: [{
						gridLines: {
							display: false,
							tickMarkLength: 15,
						}
					}]
				}
			}

			var profitChart = new Chart(profitChartCanvas, {
				type: 'bar',
				data: dataProfit,
				options: optionsProfit
			});

			return profitChart
		}

    </script>
@endif
@endpush
