<div class="card border-primary">
    <div class="card-header bg-primary text-white" >
        Serial Numbers
        @if( Auth::user()->vdb_modify_info )
            <a href="{{ route('vehicle.serials.show', [$vehicle])  }}"
               class='btn btn-sm btn-secondary float-end'>Edit Serials</a>

        @endif
    </div>

    <table class="table table-striped table-sm detail-table">
{{--        @foreach ( App\Models\Vehicle::serialFields() as $serial )--}}
{{--            @if ( $vehicle->$serial && $vehicle->$serial !== '' )--}}
{{--                <tr>--}}
{{--                    <th role="row">--}}
{{--                        {{ ucwords( str_replace('_', ' ', $serial ) ) }}--}}

{{--                    </th>--}}
{{--                    <td>{{ $vehicle->$serial }}</td>--}}
{{--                </tr>--}}
{{--            @endif--}}
{{--        @endforeach--}}

        @foreach( $vehicle->serials as $s)
            <tr>
               <td class="text-end">{{ ucwords( str_replace('_', ' ', $s->key ) ) }}</td>
                <td>{{ $s->value }}</td>
            </tr>
            @endforeach

    </table>
</div>

