
    <h1 class="text-center">Vehicle Location Report</h1>

    <p>This is the new report to more accurately show vehicle locations.
        It shows any vehicles that are either at Malley or offsite and due back. </p>
    <p>This report will replace the Chassis Here report that goes out daily when all vehicles on site are included.</p>

    <table cellspacing="2" cellpadding="2" border="1">
        <thead>
        <tr>

            <th>Vehicle</th>
            <th>WO#</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Location</th>
            <th>Last Update</th>
            <th>Checked By</th>
            <th>On</th>

        </tr>
        </thead>
        <tbody>
            @foreach( $matches as $v )
            @php
                $date = $v->dates->last() ?? null;
            @endphp
            <tr style="border-bottom: 1px solid black;">
                <td><a href="{{ route('vehicle.home', [$v->id]) }}">{{ $v->vin ?? '' }}</a></td>

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
