<br>

<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        Work Orders

        @if( Auth::user()->vdb_modify_photos )
            <form method="POST"
                  style="display:none;"
                  name="newWorkORder"
                  id="newWorkORder"
                  action="{{ url("workOrders") }}">
                {{ csrf_field() }}
                <input type="hidden" id="vehicle_id" name="vehicle_id" value="{{ $vehicle->id }}">
            </form>
            <input type="submit" form="newWorkORder" class="btn btn-sm btn-secondary float-end" value="New Work Order">
        @endif

    </div>


    <table class="table table-striped">

        <thead>
            <tr>
                <th>Number</th>
                <th>Description</th>
                <th></th>
            </tr>
        </thead>

        <tbody>
            @if( Auth::user()->vdb_work_orders  )

                @foreach( $vehicle->work_orders as $wo)
                    <tr>
                        <td>{{ $wo->number ?? "no number yet" }}</td>
                        <td>{{ $wo->title }}</td>
                        <td><a class="btn btn-sm btn-primary" href="{{ url('/workOrders/'.$wo->id.'/show') }}">Edit</a>

                            <a href="{{ url("workOrders/{$wo->id}/render") }}" class="btn btn-sm btn-info">Show PDF</a></td>
                    </tr>
                @endforeach
            @else
                @foreach( $vehicle->work_orders as $wo)
                    <tr>
                        <td>{{ $wo->number ?? "no number yet" }}</td>
                        <td>{{ $wo->title }}</td>
                        <td><a href="{{ url("workOrders/{$wo->id}/render") }}" class="btn btn-sm btn-info">Show PDF</a></td>
                    </tr>
                @endforeach
        @endif

        </tbody>
    </table>
</div>


