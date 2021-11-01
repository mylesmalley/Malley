@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Pending Ford Events</h1>

    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th>
                        ID
                    </th>
                    <th>Vehicle</th>
                    <th>Code</th>
                    <th>Milestone</th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @foreach( $pending as $event )
                    <tr>
                        <td>{{ $event->id }}</td>
                        <td><a href="{{ route('vehicle.home', [$event->vehicle_id]) }}">{{ $event->vehicle->vin }}</a></td>
                        <td>{{ $event->name }}</td>
                        <td>{{ \App\Models\VehicleDate::ford_milestone_code($event->name) }}</td>
                        <td>
                            <form action="{{ route('vehicles.submit_milestone_to_ford', [$event]) }}"
                                method="POST">
                                @csrf
                                <input type="submit" class="btn btn-primary" value="SEND">

                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection