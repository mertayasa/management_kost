<div class="row">
                
    <div class="col-12 col-md-7 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h4>Grafik Profit <span
                    id="profitSelectedYear">{{ \Carbon\Carbon::now()->year }}</span> </h4>
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
                <canvas id="profitChart" height="150"></canvas>
            </div>
        </div>
    </div>

    <div class="col-12 col-md-5 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <div class="row col-12 align-items-center justify-content-between p-0">
                    <div class="col-8">
                        <h4>Grafik Pemasukan & Pengeluaran <span
                                id="pieSelectedYear">{{ \Carbon\Carbon::now()->year }}</span>
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

@push('scripts')
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

        const profitSelectedYear = document.getElementById('profitSelectedYear')

        if(year != null){
            profitSelectedYear.innerHTML = year
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

<script>
    let yearlyPieChart
    generatePieChartData()

    function generatePieChartData(year = null) {
        const url = "{{ route('dashboard.chart_yearly') }}"
        let formData = year == null ? {year: 'now', type:'doughnut'} : {year: year, type:'doughnut'}

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