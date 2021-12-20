
    <h1 class="text-center">Chassis at Malley Industries Today</h1>




    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
            <tr>
                <th>Vehicle</th>
{{--                @foreach( $milestones as $m )--}}
{{--                    <th>{{ ucwords( str_replace('_',' ', $m)) }}</th>--}}
{{--                @endforeach--}}
                <th></th>
            </tr>
            </thead>
            <tbody>
            @forelse( $chassis as $r )
                <tr>
                    <td>
                        <a href="{{ route('vehicle.home', [$r->id]) }}">
                            {{ $r->year . ' ' . $r->make . ' ' . $r->model }}<br>
                            {{ $r->vin }}<br>
                            {{ $r->customer_name ?? 'No customer name' }} {{ $r->identifier ?? '.' }}
                        </a>

                    </td>
{{--                    @foreach( $milestones as $m )--}}
{{--                        @if ( $r->{$m} == true )--}}
{{--                            <td class="table-success">--}}
{{--                                Yes--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td class="table-danger">--}}
{{--                                No--}}
{{--                            </td>--}}
{{--                        @endif--}}
{{--                    @endforeach--}}
                    <td>
                        <a href="{{ route('vehicle.dates', [$r->id]) }}" class="btn btn-sm btn-secondary">
                            Edit
                        </a>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100">No matching vehicles</td>
                </tr>
            @endforelse
            </tbody>
        </table>
    </div>
