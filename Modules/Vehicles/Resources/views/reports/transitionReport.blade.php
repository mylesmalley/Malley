@extends('vehicles::layout')

@section('content')

            <h1 class="text-center">Transition Report</h1>

            <h3 class="text-center">
                <a href="{{ url('/vehicles/reports/transitionReport/'. ($start->format('Y')-1 ) ) }}" class="btn btn-sm btn-secondary">Previous</a>
                {{ $start->format('Y-m-d') }} to {{ $end->format('Y-m-d') }}
            <a href="{{ url('/vehicles/reports/transitionReport/'. ($end->format('Y')) ) }}" class="btn btn-sm btn-secondary">Next</a>
            </h3>

            <div class="card border-primary document-content-wrapper">

    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>Malley A#</th>
                <th>EMS A#</th>
                <th>Vehicle</th>
                <th>VIN</th>
                <th>Date In Service</th>
                <th>Date of Next Renewal</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        @forelse( $rows as $row )
            <tr>
                <td>{{ $row->malley_number }}</td>
                <td>{{ $row->customer_number }}</td>
                <td>{{ $row->year }} {{ $row->make }} {{ $row->model }}</td>
                <td>{{ $row->vin }}</td>

                <td>{{ $row->date_in_service ?? "" }}</td>
                <td>{{ $row->date_next_renewal ?? "" }}</td>

                <td><a href="{{ url('/vehicles/'.$row->id) }}" class="btn btn-sm btn-success">Go</a></td>
            </tr>
        @empty

        @endforelse
        </tbody>

    </table>


    </div>
@endsection
