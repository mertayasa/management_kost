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

@push('scripts')
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
                // console.log(data)
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
                backgroundColor(context) {
                    const index = context.dataIndex
                    const value = context.dataset.data[index]
                    return value < 0 ? 'rgb(244,174,194)' : 'rgb(145,208,246)'
                }
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
@endpush