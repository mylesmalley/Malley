@extends('vehicles::layout')

@push('script_stack')
    <script>
        let locationSummaryLabels = @json( array_keys( $locationSummary ) );
        let locationSummaryData = @json( array_values( $locationSummary ) );

        let typesLabels = @json( array_keys( $typesSummary ) );
        let typesData = @json( array_values( $typesSummary ) );

        let sourcesLabels = @json( array_keys( $sourcesSummary ) );
        let sourcesData = @json( array_values( $sourcesSummary ) );

        let severityLabels = @json( array_keys( $severitySummary ) );
        let severityData = @json( array_values( $severitySummary ) );
    </script>
    <script src="{{ mix('js/vehicles/inspectionReport.js') }}"></script>
    @endpush

@section('content')

    <h1 class="text-center">Inspection Report</h1>


    @includeIf('vehicles::inspections.inspectionReportFormComponent')

    <h2 class="d-print-none">Summary</h2>


{{--    <canvas--}}
{{--        class="piechart"--}}
{{--        width="500"--}}
{{--        height="500"--}}
{{--        style="page-break-after: always; display: none;"--}}
{{--        id="byLocationChartBig"></canvas>--}}


    <a class="btn btn-secondary btn-lg"
       href="{{ route("inspection.fullPageGraphs", [
        'start_date' => request()->input('start_date'),
        'end_date' => request()->input('end_date'),
        'order' => request()->input('order'),
        'column' => request()->input('column'),
        'focus_column' => 'location'
                                        ]) }}">
       Show Full Page Graphs</a>

    @if( count( $results))

    <div class="row ">
        <div class="col-lg-3 col-sm-12"
             style="break-inside: avoid; page-break-after: auto; ">

            <div class="card border-primary"
                 style="break-inside: avoid; page-break-after: always; ">


            <div class="card-header bg-primary text-white">
                By Location
            </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-12">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Location</th>
                                    <th>Count</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $locationSummary as $k => $v )
                                    <tr>
                                        <td>
                                            <a href="{{ route("inspection.focused.report", [
                                    'start_date' => request()->input('start_date'),
                                    'end_date' => request()->input('end_date'),
                                    'order' => request()->input('order'),
                                    'column' => request()->input('column'),
                                    'focus_column' => 'location',
                                    'focus_value' => $k,
                                ]) }}">
                                                {{ $k }}</a>
                                        </td>
                                        <td>{{ $v }}</td>
                                        <td>{{ number_format( 100* ( $v /  count($results) ), 1) }}%</td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="col-sm-6 col-md-12">
                            <canvas class="piechart" id="byLocationChart"></canvas>

                        </div>
                    </div>


{{--                <canvas style=" height:3in !important;"  class="d-none d-print-block"  id="byLocationChartBig"></canvas>--}}

            </div>
        </div>










        <div class="col-lg-3 col-sm-12" style="break-inside: avoid; page-break-after: auto; ">
            <div class="card border-primary"
                 style="break-inside: avoid; page-break-after: always; ">

                <div class="card-header bg-primary text-white">
                    By Source
                </div>

                <div class="row">
                    <div class="col-sm-6 col-md-12">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Source</th>
                        <th>Count</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $sourcesSummary as $k => $v )
                        <tr>
                            <td>
                                <a href="{{ route("inspection.focused.report", [
                                    'start_date' => request()->input('start_date'),
                                    'end_date' => request()->input('end_date'),
                                    'order' => request()->input('order'),
                                    'column' => request()->input('column'),
                                    'focus_column' => 'source',
                                    'focus_value' => $k,
                                ]) }}">
                                    {{ $k }}</a>
                            </td>
                            <td>{{ $v }}</td>
                            <td>{{ number_format( 100* ( $v /  count($results) ), 1) }}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>
                    <div class="col-sm-6 col-md-12">

                    <canvas class="piechart" id="bySourceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>





        <div class="col-lg-3 col-sm-12 "
             style="break-inside: avoid; page-break-after: auto; ">
            <div class="card border-primary"
                 style="break-inside: avoid; page-break-after: always; ">

                <div class="card-header bg-primary text-white">
                    By Severity
                </div>


                <div class="row">
                    <div class="col-sm-6 col-md-12">

                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Severity</th>
                        <th>Count</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $severitySummary as $k => $v )
                        <tr>
                            <td>
                                <a href="{{ route("inspection.focused.report", [
                                    'start_date' => request()->input('start_date'),
                                    'end_date' => request()->input('end_date'),
                                    'order' => request()->input('order'),
                                    'column' => request()->input('column'),
                                    'focus_column' => 'severity',
                                    'focus_value' => $k,
                                ]) }}">
                                    {{ $k }}</a>
                            </td>
                            <td>{{ $v }}</td>
                            <td>{{ number_format( 100* ( $v /  count($results) ), 1) }}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

                    </div>
                            <div class="col-sm-6 col-md-12">
                <canvas class="piechart" id="bySeverityChart"></canvas>
                            </div>
                </div>

            </div>
        </div>



        <div class="col-lg-3 col-sm-12 " style="break-inside: avoid; page-break-after: auto; ">
            <div class="card border-primary"
                 style="break-inside: avoid; page-break-after: always; ">

                <div class="card-header bg-primary text-white">
                    By Type
                </div>
                <div class="row">
                    <div class="col-sm-6 col-md-12">

                    <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Type</th>
                        <th>Count</th>
                        <th></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach( $typesSummary as $k => $v )
                        <tr>
                            <td>
                                <a href="{{ route("inspection.focused.report", [
                                    'start_date' => request()->input('start_date'),
                                    'end_date' => request()->input('end_date'),
                                    'order' => request()->input('order'),
                                    'column' => request()->input('column'),
                                    'focus_column' => 'type',
                                    'focus_value' => $k,
                                ]) }}">
                                    {{ $k }}</a>
                            </td>
                            <td>{{ $v }}</td>
                            <td>{{ number_format( 100* ( $v /  count($results) ), 1) }}%</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                    </div>
                        <div class="col-sm-6 col-md-12">

                        <canvas class="piechart" id="byTypeChart"></canvas>
                        </div>
                </div>
            </div>
        </div>




    </div>

    @endif

    <hr>

    <h2 class="d-print-none">Incidents</h2>

    <div class="card border-primary d-print-none document-content-wrapper">

        <table class="table table-striped table-sm table-hover">
            <thead>
            <tr>
        <thead>
            <tr>
                <th> Vehicle </th>
                <th> Date </th>
                <th> Descriptions </th>
{{--                <th> Category </th>--}}
                <th> Location </th>
                <th> Type </th>
                <th> Source </th>
                <th> Severity </th>
            </tr>
        </thead>
        <tbody>
            @forelse( $results as $res )
                <tr>
                    <td><a href="{{ route('vehicle.home', [$res->vehicle_id ]) }}">{{ $res->vehicle->identifier }}</a></td>
                    <td> {{ $res->date_entered }}  </td>
                    <td> {{ $res->description  }} </td>
{{--                    <td> {{ $res->life_step }} </td>--}}
                    <td> {{ $res->location }} </td>
                    <td> {{ $res->type }} </td>
                    <td> {{ $res->source }} </td>
                    <td> {{ $res->severity }} </td>
                </tr>

            @empty
                <tr>
                    <td colspan="7"> No inspection issues during this period. </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    </div>
@endsection

@push('script_stack')
    <script>
        function reload_page()
        {
            console.log( 'reload page');

            let start_date = document.getElementById('start_date').value;
            let end_date = document.getElementById('end_date').value;
            let column = document.getElementById('column').value;
            let order = document.getElementById('order').value;

            window.location.href = `/vehicles/inspections?start_date=${start_date}&end_date=${end_date}&column=${column}&order=${order}`;
        }

        document.getElementById('start_date').addEventListener('change', reload_page);
        document.getElementById('end_date').addEventListener('change', reload_page);
        document.getElementById('column').addEventListener('change', reload_page);
        document.getElementById('order').addEventListener('change', reload_page);
    </script>

@endpush
