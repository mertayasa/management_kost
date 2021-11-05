<div class="card flex-fill">
    <div class="card-header">
        <div class="row col-12 align-items-center justify-content-between p-0">
            <div class="col-8">
                <h4>Grafik Kamar</h4>
            </div>
        </div>
    </div>
    <div class="card-body">
        <canvas id="emptyRoomChart"></canvas>
    </div>
</div>


@push('scripts')
    <script>
        let emptyRoom
        generateEmptyRoomData()

        function generateEmptyRoomData(year = null) {
            const url = "{{ route('dashboard.empty_room') }}"

            $.ajax({
                url: url,
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': "{{ csrf_token() }}"
                },
                dataType: 'json',
                success: function(data) {
                    // console.log(data)
                    if (data.code === 1) {
                        emptyRoom = generateEmptyRoomChart(data)
                    }

                    if (data.code === 0) {
                        console.log('error')
                    }
                }
            })
        }

        function generateEmptyRoomChart(data) {
            const emptyRoomChart = document.getElementById("emptyRoomChart").getContext('2d')

            const dataInOut = {
                labels: data.label,
                datasets: [{
                    label: 'Kamar Isi',
                    data: data.isi,
                    borderColor: 'rgb(244,174,194)',
                    backgroundColor: 'rgb(244,174,194)',
                }, {
                    label: 'Kamar Kosong',
                    data: data.kosong,
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

            var chartEmptyRoom = new Chart(emptyRoomChart, {
                type: 'bar',
                data: dataInOut,
                options: optionsInOut
            });

            return chartEmptyRoom
        }
    </script>
@endpush
