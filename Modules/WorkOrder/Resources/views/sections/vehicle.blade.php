<form action="{{ url("/workOrders/{$workOrder->id}/vehicleDetails") }}"
      name="vehicleForm"
      id="vehicleForm"
      method="POST">
    {{ method_field("PATCH") }}
    {{ csrf_field() }}
</form>

<h2>Vehicle

    @if ( $mode === "vehicle")
        <input type="submit" form="vehicleForm" class='btn btn-primary float-right' value="Save">
    @elseif( $mode === "show" )
        <a href="{{ url("workOrders/{$workOrder->id}/vehicle") }}" class='btn btn-info float-right'>Edit</a>
    @else

    @endif

</h2>
<div class="card border-primary document-content-wrapper">

<table class="table table-sm">
    <thead class="bg-secondary text-white">
        <tr>
            <th>VIN</th>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>Odometer</th>
        </tr>
    </thead>
    <tbody>
        @if ( $mode === "vehicle")
            <tr>
                <td>{{ $workOrder->vehicle->vin }}</td>
                <td>{{ $workOrder->vehicle->make }}</td>
                <td>{{ $workOrder->vehicle->model }}</td>
                <td>{{ $workOrder->vehicle->year }}</td>
                <td>
                    <input name="odometer" id="odometer"
                           class="form-control"
                           aria-label=""
                           form="vehicleForm"
                           type="text"
                           value="{{ old('odometer', $workOrder->odometer ) ?? 0 }}">
                </td>
            </tr>
        @else

            <tr>
                <td>{{ $workOrder->vehicle->vin }}</td>
                <td>{{ $workOrder->vehicle->make }}</td>
                <td>{{ $workOrder->vehicle->model }}</td>
                <td>{{ $workOrder->vehicle->year }}</td>
                <td>{{ $workOrder->odometer ?? 0 }}</td>
            </tr>
        @endif

    </tbody>
</table>
</div>
