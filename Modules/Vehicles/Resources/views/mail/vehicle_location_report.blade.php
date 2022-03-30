
    <h1 class="text-center">Vehicle Location Report</h1>


    <table>
        <thead>
        <tr>

            <th>Vehicle</th>
            <th>WO#</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Location</th>
            <td>Last Update</td>
            <td>Checked By</td>
            <th>On</th>

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

                <td>{{ $v->make ?? '' }}</td>
                <td>{{ $v->model ?? '' }}</td>
                <td>{{ $v->year ?? '' }}</td>
                <td>{{ $v->location ?? 'Err' }}</td>
                <td>{{ ucwords( str_replace(['_'], [' '],  $date->name ) ) ?? '' }}</td>
                <td>{{ $date->user->first_name ?? "" }}</td>
                <td>
                    @if ($date)
                        {{ \Carbon\Carbon::parse( $date->timestamp )->format('Y-m-d \a\t g:i') }}
                    @endif
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>
