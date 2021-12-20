
    <h1 class="text-center">Chassis at Malley Industries Today</h1>


        <table cellpadding="5" cellspacing="5" class="table table-sm table-striped table-hover">
            <thead>
            <tr>

                <th>Ref #</th>
                <th>VIN</th>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>Customer</th>
{{--                @foreach( $milestones as $m )--}}
{{--                    <th>{{ ucwords( str_replace('_',' ', $m)) }}</th>--}}
{{--                @endforeach--}}
                <th>Date Arrived</th>
            </tr>
            </thead>
            <tbody>
            @forelse( $chassis as $r )
                <tr>
                    <td>{{ $r->identifier }}</td>
                    <td><a href="{{ route('vehicle.home', [$r->id]) }}">{{ $r->vin  }}</a></td>
                    <td>{{ $r->make }}</td>
                    <td>{{ $r->model }}</td>
                    <td>{{ $r->year }}</td>
                    <td>{{ $r->customer_name }}</td>
                    <td> {{ $r->arrival }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="100">No matching vehicles</td>
                </tr>
            @endforelse
            </tbody>
        </table>
