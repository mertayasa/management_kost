<div class="card flex-fill">
    <div class="card-header">
        <div class="row col-12 align-items-center justify-content-between p-0">
            <div class="col-8">
                <h4>Grafik Pemasukan & Pengeluaran <span id="pieSelectedYear">{{ \Carbon\Carbon::now()->year }}</span>
                </h4>
            </div>
            <div class="col-4 text-right px-0">
                <div class="card-stats-title">
                    <div class="dropdown d-inline">
                        <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown" href="#"
                            id="orders-month">Pilih Tahun</a>
                        <ul class="dropdown-menu dropdown-menu-sm">
                            @foreach ($dashboard_data['tahun_pemasukan'] as $year)
                                <li><a href="javascript:void(0)" class="dropdown-item"
                                        onclick="generatePieChartData('{{ $year }}')">{{ $year }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="yearlyDoughnutChart"></canvas>
    </div>
</div>

@push('scripts')
    <script>
        let yearlyPieChart
        generatePieChartData()

        function generatePieChartData(year = null) {
            const url = "{{ route('dashboard.chart_yearly') }}"
            let formData = year == null ? {
                year: 'now',
                type: 'doughnut'
            } : {
                year: year,
                type: 'doughnut'
            }

            const pieSelectedYear = document.getElementById('pieSelectedYear')

            if (year != null) {
                pieSelectedYear.innerHTML = year
            }

            $.ajax({
                url: url,
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                data: formData,
                dataType: 'json',
                success: function(data) {
                    if (data.code === 1) {
                        if (year != null) {
                            yearlyPieChart.destroy()
                            yearlyPieChart = showPieChart(data)
                        } else {
                            yearlyPieChart = showPieChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function showPieChart(data) {
            let doughnutChart = $('#yearlyDoughnutChart');
            const labels = ["Pemasukan", "Pengeluaran"]
            let doughtChartRating = new Chart(doughnutChart, {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Keuangan',
                        backgroundColor: [
                            'rgb(145,208,246)',
                            'rgb(244,174,194)',
                        ],
                        pointBorderWidth: 0,
                        pointHoverRadius: 10,
                        pointHoverBorderWidth: 1,
                        pointRadius: 3,
                        fill: false,
                        borderWidth: 1,
                        data: [data.pemasukan, data.pengeluaran]
                    }, ]
                },
                options: {
                    responsive: true,
                    maintainAspectRatio: false,
                    // plugins: {
                    //     tooltip: {
                    //         callbacks: {
                    //             title: tooltipItems => {
                    //                 return 'Rating ' + tooltipItems[0].label
                    //             },
                    //             label: tooltipItems => {
                    //                 return ''
                    //             },
                    //             afterLabel: tooltipItems => {
                    //                 return tooltipItems.formattedValue + ' Responden'
                    //             }
                    //         },
                    //     },
                    // },
                    animation: {
                        duration: 750,
                    },
                }
            });

            return doughtChartRating
        }
    </script>
@endpush
