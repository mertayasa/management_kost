<div class="card flex-fill">
    <div class="card-header">
        <h4>Grafik Pemasukan Kost</h4>
        <div class="card-header-action">
            <div class="card-stats-title">
                <div class="dropdown d-inline">
                    <a class="font-weight-600 btn btn-danger dropdown-toggle" data-toggle="dropdown"
                        href="#" id="orders-month">Pilih Tahun</a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                        @foreach ($dashboard_data['tahun_pemasukan'] as $year)
                            <li><a href="javascript:void(0)" class="dropdown-item"
                                    onclick="generateIncomeKost('{{ $year }}')">{{ $year }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="financePerRoom"></canvas>
    </div>
</div>


@push('scripts')
    <script>
        let financePerRoom
        generateIncomeKost()

        function generateIncomeKost(year = null) {
            const url = "{{ route('dashboard.income_kost') }}"

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
                            financePerRoom.destroy()
                            financePerRoom = generateIncomeKostChart(data)
                        } else {
                            financePerRoom = generateIncomeKostChart(data)
                        }
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function generateIncomeKostChart(data) {
            const financePerRoom = document.getElementById("financePerRoom").getContext('2d')

            const dataInOut = {
                labels: data.label,
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
                indexAxis: 'y',
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
                            // stepSize: 1500,
                            // callback: function(value, index, values) {
                            //     return 'Rp' + value;
                            // }
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

            var chartFinanceRoom = new Chart(financePerRoom, {
                type: 'bar',
                data: dataInOut,
                options: optionsInOut
            });

            return chartFinanceRoom
        }
    </script>
@endpush
