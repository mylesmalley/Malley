<table>
    <tr>
        <td>
            Malley Ref
        </td>
        <td>{{ $workOrder->vehicle->identifier ?? '' }}</td>
    </tr>
    <tr>
        <td>VIN</td>
        <td>{{ $workOrder->vehicle->vin ?? '' }}</td>
    </tr>
    <tr>
        <td>Vehicle</td>
        <td>{{ $workOrder->vehicle->make ?? '' }} {{ $workOrder->vehicle->model ?? '' }} {{ $workOrder->vehicle->year ?? '' }}</td>
    </tr>
    <tr>
        <td>Odometer</td>
        <td>{{ $workOrder->odometer ?? "" }}</td>
    </tr>
</table>
