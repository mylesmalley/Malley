@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-1">Dashboard

            </h1>
        </div>
    </div><div class="row">
    <div class="col-md-6">
        <canvas id="myChart"
                width="400"
                height="400"></canvas>
    </div>

    <div class="col-md-6">
        <canvas id="lastMonthChart"
                width="400"
                height="400"></canvas>
    </div>


        <div class="col-md-6">
            <canvas id="warrantyChart"
                    width="400"
                    height="400"></canvas>
        </div>
</div>

    @endsection

@section('headerScripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js"
            integrity="sha512-s+xg36jbIujB2S2VKfpGmlC3T5V2TF3lY48DX7u2r9XzGzgPsa6wTpOQA7J9iffvdeBN0q9tKzRxVxw1JviZPg=="
            crossorigin="anonymous"></script>
@endsection

@section('scripts')
    <script>


        var warranty = document.getElementById('warrantyChart').getContext('2d');
        var warrantyChart = new Chart(warranty, {
            type: 'bar',
            data: {
                labels: {!!  $warrantyLabels !!},
                datasets: {!! $warrantyData !!},
                borderWidth: 1
            },
            options: {
                title: {
                    display: true,
                    text: "Warranty Claims from Last 12 Months"
                }
            }
        });



        var lastMonth = document.getElementById('lastMonthChart').getContext('2d');
        var lastMonthChart = new Chart(lastMonth, {
            type: 'pie',
            data: {
                labels: {!!  $recentInspectionsLabels !!},
                datasets: {!! $recentInspectionssData !!},
                borderWidth: 1
            },
            options: {
                title: {
                    display: true,
                    text: "Defects from Last Quarter"
                }
            }
        });

        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!!  $labels !!},
                    datasets: {!! $data !!},
                    borderWidth: 1
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                title: {
                    display: true,
                    text: "Inspection Severity Over Time"
                }
            }
        });
    </script>
    @endsection
