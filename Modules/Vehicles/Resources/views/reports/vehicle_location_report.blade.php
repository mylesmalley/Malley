@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Vehicle Location</h1>

    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
{{--                    <th>--}}
{{--                        ID--}}
{{--                    </th>--}}
                    <th>Vehicle</th>
                    <th>WO#</th>
                    <th>Make</th>
                    <th>Model</th>
                    <th>Year</th>
                    <th>Location</th>
                    <td>Last Update</td>
                    <td>Checked By</td>
                    <th>On</th>
{{--                    <th>Code</th>--}}
{{--                    <th>Milestone</th>--}}
{{--                    <th></th>--}}
                </tr>
            </thead>

            <tbody>
                @foreach( $matches as $v )
                    @php
                        $date = $v->dates->last() ?? null;
                    @endphp
                    <tr onclick="window.location = '{{ route('vehicle.home', [$v->id]) }}'">
                        <td>{{ $v->vin ?? '' }}</td>

                        <td>{{ $v->firstWorkOrder() ?? "" }}</td>

{{--                        <td>{{ $v->id }}</td>--}}
                        <td>{{ $v->make ?? '' }}</td>
                        <td>{{ $v->model ?? '' }}</td>
                        <td>{{ $v->year ?? '' }}</td>
                        <td>{{ $v->location ?? 'Err' }}</td>
                        <td>{{ ucwords( str_replace(['_'], [' '],  $date->name ) ) ?? '' }}</td>
                        <td>{{ $date->user->first_name ?? "" }}</td>
                        <td>@if ($date)
                                {{ \Carbon\Carbon::parse( $date->timestamp )->format('Y-m-d \a\t g:i') }}
                            @endif
                        </td>
{{--                        <td><a href="{{ route('vehicle.home', [$event->vehicle_id]) }}">{{ $event->vehicle->vin }}</a></td>--}}
{{--                        <td>{{ $event->name }}</td>--}}
{{--                        <td>{{ \App\Models\VehicleDate::ford_milestone_code($event->name) }}</td>--}}
{{--                        <td>--}}
{{--                            <form action="{{ route('vehicles.submit_milestone_to_ford', [$event]) }}"--}}
{{--                                method="POST">--}}
{{--                                @csrf--}}
{{--                                <input type="submit" class="btn btn-primary" value="SEND">--}}

{{--                            </form>--}}
{{--                            <a href="{{ route('vehicles.test_ford_milestone', [ $event ]) }}" class="btn btn-info">Test</a>--}}
{{--                        </td>--}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection