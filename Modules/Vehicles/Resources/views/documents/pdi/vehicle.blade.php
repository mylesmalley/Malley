<table>
    <thead>
        <tr>
            <th>VIN</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Work Order</th>

            <th>Customer</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td> {{ $vehicle->vin ?? " " }} &nbsp;</td>
             <td> {{ $vehicle->make ?? " " }} &nbsp; &nbsp;</td>
            <td> {{ $vehicle->model ?? " " }} &nbsp; &nbsp;</td>
            <td> {{ $vehicle->year ?? " " }} &nbsp; &nbsp;</td>
            <td>
                @if( $vehicle->id === 3086)

                @else

                {{ $vehicle->work_order ?? " " }} &nbsp;
                    @endif
            </td>

            <td>{{ trim( $vehicle->customer_name ) ?? 'N/A' }}</td>
        </tr>
    </tbody>

</table>
