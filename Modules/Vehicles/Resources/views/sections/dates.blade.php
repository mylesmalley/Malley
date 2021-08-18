<div class="card border-primary">
    <div class="card-header bg-primary text-white" >
        Dates

        @if( Auth::user()->vdb_modify_photos )
            <a href="{{ url('vehicles/'.$vehicle->id.'/dates' ) }}"
               class='btn btn-sm btn-secondary float-end'>Edit Dates</a>
        @endif
    </div>
    <table class="table table-striped table-sm detail-table">
        @foreach ( App\Models\Vehicle::dateFields() as $date )
            @php
                $notes = "{$date}_notes"
            @endphp
            @if ( $vehicle->$date && $vehicle->$date !== '' )
                <tr>
                    <th role="row">
                        {{ str_replace( 'Date', '', ucwords( str_replace('_', ' ', $date ) )  )}}
                    </th>
                    <td>{{ $vehicle->$date }}
                        @if ($vehicle->{$notes} )
                            <br > <span class="text-secondary">


                            {{  $vehicle->{$notes} }}</span>
                            @endif
                    </td>
                </tr>
            @endif
        @endforeach

    </table>

</div>
