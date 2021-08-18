@extends('vehicles::layout')

@section('content')

            <h1 class="text-center">Chassis at Thornton or York</h1>

    {!! $rows->links() !!}
    <div class="card border-primary document-content-wrapper">

    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>Date Arrived</th>
                <th>ID</th>
                <th>Customer</th>

                <th>Vehicle</th>
                <th>VIN</th>
{{--                <th>Drive</th>--}}
                <th>Notes</th>
                <th></th>
            </tr>
        </thead>
        <tbody>

        @forelse( $rows as $row )
            <tr>
                <td>{{ $row->date_at_york_or_thornton }}</td>

                <td>{{ $row->identifier }}</td>
                <td>{{ $row->customer_name }}</td>

                <td>{{ $row->year }} {{ $row->make }} {{ $row->model }}</td>
                <td>{{ $row->vin }}</td>
{{--                <td>{{ $row->drive }}</td>--}}
                <td>{{ $row->date_at_york_or_thornton_notes }}</td>

                <td><a href="{{ url('/vehicles/'.$row->id) }}" class="btn btn-sm btn-success">Go</a></td>
            </tr>
        @empty

        @endforelse
        </tbody>

    </table>
    </div>
    {!! $rows->links() !!}

@endsection
