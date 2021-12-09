<div class="card border-primary">
    <div class="card-header bg-primary text-white" >
        Dates

{{--        @if( Auth::user()->vdb_modify_photos )--}}
            <a href="{{ route('vehicle.dates', [$vehicle]) }}"
               class='btn btn-sm btn-secondary float-end'>Edit Dates</a>
{{--        @endif--}}
    </div>
    <table class="table table-striped table-sm detail-table">
        <tr>
            <th role="row">
                Added to Database
            </th>
            <td>
                {{ \Carbon\Carbon::create($vehicle->created_at)->format('Y-m-d') }}
            </td>
            <td>

            </td>
        </tr>
        @foreach( $vehicle->dates as $date )
            <tr>
                <th role="row">
                    {{ ucwords( str_replace('_', ' ', $date->name ) ) }}
                </th>
                <td>
                    {{ \Carbon\Carbon::create($date->timestamp)->format('Y-m-d') }}
                </td>
                <td>
                    {{ $date->notes }}
                </td>
            </tr>
            @endforeach
{{--        @foreach ( App\Models\Vehicle::dateFields() as $date )--}}
{{--            @php--}}
{{--                $notes = "{$date}_notes"--}}
{{--            @endphp--}}
{{--            @if ( $vehicle->$date && $vehicle->$date !== '' )--}}
{{--                <tr>--}}
{{--                    <th role="row">--}}
{{--                        {{ str_replace( 'Date', '', ucwords( str_replace('_', ' ', $date ) )  )}}--}}
{{--                    </th>--}}
{{--                    <td>{{ $vehicle->$date }}--}}
{{--                        @if ($vehicle->{$notes} )--}}
{{--                            <br > <span class="text-secondary">--}}


{{--                            {{  $vehicle->{$notes} }}</span>--}}
{{--                            @endif--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--            @endif--}}
{{--        @endforeach--}}

    </table>

</div>
