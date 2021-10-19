<html lang="en">
    <head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            h1 {
                text-align: center;
                font-family: sans-serif;
                font-size: 80pt;
            }
        </style>
    </head>
    <body>
    <h1>
        {{ request('start_date' ?? 'start') }} to {{ request('end_date') ?? 'end date' }}
        <br>BY LOCATION</h1>
    <canvas
            width="1000" height="1000"
            class="piechart" id="byLocationChart"></canvas>
    <span style="page-break-after: always;">-</span>

    <h1>
        {{ request('start_date' ?? 'start') }} to {{ request('end_date') ?? 'end date' }}
        <br>
        BY SOURCE</h1>

    <canvas
            width="1000" height="1000"
            class="piechart" id="bySourceChart"></canvas>
    <span style="page-break-after: always;">-</span>

    <h1>        {{ request('start_date' ?? 'start') }} to {{ request('end_date') ?? 'end date' }}
        <br>
        BY SEVERITY</h1>

    <canvas
            width="1000" height="1000"
            class="piechart" id="bySeverityChart"></canvas>
    <span style="page-break-after: always;">-</span>

    <h1>        {{ request('start_date' ?? 'start') }} to {{ request('end_date') ?? 'end date' }}
        <br>BY TYPE</h1>

    <canvas
            width="1000" height="1000"
            class="piechart" id="byTypeChart"></canvas>




    <script

            src="https://unpkg.com/chart.js-plugin-labels-dv/dist/chartjs-plugin-labels.min.js"></script>

        <script>
            let locationSummaryLabels = @json( array_keys( $locationSummary ) );
            let locationSummaryData = @json( array_values( $locationSummary ) );

            let typesLabels = @json( array_keys( $typesSummary ) );
            let typesData = @json( array_values( $typesSummary ) );

            let sourcesLabels = @json( array_keys( $sourcesSummary ) );
            let sourcesData = @json( array_values( $sourcesSummary ) );

            let severityLabels = @json( array_keys( $severitySummary ) );
            let severityData = @json( array_values( $severitySummary ) );

            const colours = [
                "#9393ff",
                "#00C49A",
                "#F8E16C",
                "#72839A",
                "#FB8F67",
                "#C1666B",
                "#28c937",
                "#A0EADE",
                "#b97eea",
                "#bead3c",
                "#FFC2B4",
                "#58afcb",
            ];


            let plugs = {
                labels: {
                    // render 'label', 'value', 'percentage', 'image' or custom function, default is 'percentage'
                    render: 'label',
                    // font size, default is defaultFontSize
                    fontSize: 20,
                    position: 'border',
                    // overlap: false,
                    // font color, can be color array for each data or function for dynamic color, default is defaultFontColor
                    fontColor: '#000',
                },
                legend: {
                    labels: {
                        // This more specific font property overrides the global property
                        font: {
                            size: 60
                        }
                    }
                }
            };



            /*
                By location
             */


            let locChart = new Chart(
                document.getElementById('byLocationChart'),
                {
                    type: 'pie',
                    data: {
                        labels: locationSummaryLabels,
                        datasets: [
                            {
                                data: locationSummaryData,
                                backgroundColor:  colours ,
                            }
                        ]
                    },
                    options: {
                        plugins: plugs
                    }
                }
            )







            new Chart(
                document.getElementById('bySourceChart'),
                {
                    type: 'pie',
                    data: {
                        labels: sourcesLabels,
                        datasets: [
                            {
                                data: sourcesData,
                                backgroundColor:  colours ,
                            }
                        ]
                    },
                    options: {
                        plugins: plugs
                    }
                }
            )

            new Chart(
                document.getElementById('bySeverityChart'),
                {
                    type: 'pie',
                    data: {
                        labels: severityLabels,
                        datasets: [
                            {
                                data: severityData,
                                backgroundColor:  colours ,
                            }
                        ]
                    },
                    options: {
                        plugins: plugs
                    }
                }
            )

            new Chart(
                document.getElementById('byTypeChart'),
                {
                    type: 'pie',
                    data: {
                        labels: typesLabels,
                        datasets: [
                            {
                                data: typesData,
                                backgroundColor:  colours ,
                            }
                        ]
                    },
                    options: {
                        plugins: plugs
                    }
                }
            )






        </script>
    </body>
</html>
