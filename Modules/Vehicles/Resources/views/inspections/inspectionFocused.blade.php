@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Inspection Report</h1>

    <div class="d-screen">
        <h2 class="text-secondary text-center">{{ request()->input('focus_value') ?? "Focus" }} Incidents from  {{ request()->start_date ?? \Carbon\Carbon::now()->subMonth()->format('Y-m-d') }}
            to
            {{ request()->end_date ?? date("Y-m-d") }}
        </h2>
    </div>

    <h2 class="d-print-none">Incidents</h2>

    <a class="btn btn-primary d-print-none"
        href="{{ route("inspection.report", [
                                    'start_date' => request()->input('start_date'),
                                    'end_date' => request()->input('end_date'),
                                    'order' => request()->input('order'),
                                    'column' => request()->input('column')
                                ]) }}">
        Back to Full Report </a>

    <div class="card border-primary document-content-wrapper">

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
                    <td><a href="{{ route('vehicle.query', [$res->vehicle_id ]) }}">{{ $res->vehicle->identifier }}</a></td>
                    <td> {{ $res->date_entered }}  </td>
                    <td> {{ $res->description  }} </td>
{{--                    <td> {{ $res->life_step }} </td>--}}
                    <td> {{ $res->location }} </td>
                    <td style="white-space: nowrap;"> {{ $res->type }} </td>
                    <td style="white-space: nowrap;"> {{ $res->source }} </td>
                    <td style="white-space: nowrap;"> {{ $res->severity }} </td>
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

@section('scripts')
    <script>
        function reload_page()
        {
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

@endsection
