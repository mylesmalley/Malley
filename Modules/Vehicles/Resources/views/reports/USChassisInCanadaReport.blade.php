@extends('vehicles::layout')

@section('content')

            <h1 class="text-center">US Chassis Still in Canada</h1>

    {!! $rows->links() !!}

            <div class="card border-primary document-content-wrapper">

    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th></th>
                <th>Customer</th>

                <th>Vehicle</th>
                <th>VIN</th>
                <th>Drive</th>
                <th>Entered Canada</th>
{{--                <th>Left Date</th>--}}
                <th></th>

            </tr>
        </thead>
        <tbody>

        @forelse( $rows as $row )
            <tr>
                <td>{{ $row->identifier }}</td>
                <td>{{ $row->customer_name }}</td>

                <td>{{ $row->year }} {{ $row->make }} {{ $row->model }}</td>
                <td>{{ $row->vin }}</td>
                <td>{{ $row->drive }}</td>

                <td>{{ \Carbon\Carbon::create($row->date_entry_to_canada)->format('Y-m-d') ?? "" }}</td>
{{--                <td>{{ $row->date_exit_from_canada ?? "" }}</td>--}}

                <td><a href="{{ route('vehicle.home', [$row->id]) }}" class="btn btn-sm btn-success">Go</a></td>
            </tr>
        @empty

        @endforelse
        </tbody>

    </table>

            </div>

            {!! $rows->links() !!}

@endsection
