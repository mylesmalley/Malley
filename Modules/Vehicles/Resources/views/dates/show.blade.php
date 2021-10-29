@extends('vehicles::layout')

@section('content')



    <h1 class="text-center">
        Dates for  <a href="{{ route('vehicle.home', [$vehicle]) }}">{{ $vehicle->identifier }}</a>
    </h1>

    <div class="card border-primary document-content-wrapper">

        <table class="table table-striped">
            <thead class="bg-primary text-white">
            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Notes</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

                @forelse( $vehicle->dates as $date)
                    <tr>
                        <th role="row">
                            {{ ucwords( str_replace('_', ' ', $date->name ) ) }}
                        </th>
                        <td>
                            {{ \Carbon\Carbon::create($date->timestamp)->format('Y-m-d') }}
                        </td>
                        <td>
                            {{ $date->notes }}
                        </td>
                        <td>
                            <a href="{{ route('vehicle.date.edit', [$vehicle, $date ]) }}" class="btn btn-sm btn-success">Change</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100">No dates added for this van... yet!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>


@endsection


