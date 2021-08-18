
    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            About This Van
            @if( Auth::user()->vdb_modify_info )
                <a href="{{ url('vehicles/'.$vehicle->id.'/edit' ) }}"
                   class='btn btn-sm btn-secondary float-end'>Edit Vehicle Details</a>
            @endif



        </div>

        <table class="table table-sm table-striped detail-table">
            <tr>
                <th scope="row">Work Order</th>
                <td>
                    {{ $vehicle->work_order ?? '' }}

                    @if ($vehicle->work_order )
                        <a href="{{ url('/vehicles/'.$vehicle->id.'/bom') }}"
                           class="badge badge-pill bg-secondary"
                        >See Vehicle BOM</a>
                    @endif
                </td>

                <th scope="row">Make</th>
                <td>{{ $vehicle->make ?? '' }} </td>

                <th scope="row">Interior Colour</th>
                <td>{{ $vehicle->interior_colour ?? '' }} </td>
            </tr>
            <tr>

                <th scope="row">Customer</th>
                <td>{{ $vehicle->customer_name ?? '' }}</td>

                <th scope="row">Model</th>
                <td>{{ $vehicle->model ?? '' }} </td>

                <th scope="row">Exterior Colour</th>
                <td>{{ $vehicle->exterior_colour ?? '' }} </td>
            </tr>
            <tr>
                <th scope="row">VIN</th>
                <td>{{ $vehicle->vin ?? '' }}</td>

                <th scope="row">Year</th>
                <td>{{ $vehicle->year ?? '' }} </td>

                <th scope="row">OEM Dealer</th>
                <td>{{ $vehicle->oem_dealer ?? '' }} </td>
            </tr>

            <tr>
                <th scope="row">Malley ID Number</th>
                <td>{{ $vehicle->malley_number ?? '' }}</td>

                <th scope="row">Country</th>
                <td>{{ $vehicle->country ?? '' }} </td>



                <th rowspan="2" scope="row">Notes</th>
                <td rowspan="2">{{ $vehicle->notes ?? '' }} </td>
            </tr>

            <tr>
                <th scope="row">Customer Number</th>
                <td>{{ $vehicle->customer_number ?? '' }}</td>

                <th scope="row">Wheelbase</th>
                <td>{{ $vehicle->wheelbase ?? '' }} </td>
            </tr>

            <tr>
                <th scope="row">Dealer</th>
                <td>{{ $vehicle->dealer->name ?? '' }}</td>

                <th scope="row">Roof Height</th>
                <td>{{ $vehicle->roof_height ?? '' }} </td>

                <th  rowspan="2" scope="row">Tags <a href="{{ url("/vehicles/{$vehicle->id}/tags") }}" class="btn btn-sm btn-primary">Edit</a></th>
                <td rowspan="2">
                    @foreach( $vehicle->tags as $tag)
                        <a href="{{ url('vehicles/tags/'.$tag->id ) }}" class="badge bg-dark">{{ $tag->name }}</a>

                    @endforeach
                </td>
            </tr>

            <tr>
                <th scope="row">Refurb Number</th>
                <td>{{ $vehicle->refurb_number ?? '' }}</td>

                <th scope="row">Fuel</th>
                <td>{{ $vehicle->fuel ?? '' }} </td>
            </tr>

            <tr>
                <td></td>
                <td></td>

                <th scope="row">Drive</th>
                <td>{{ $vehicle->drive ?? '' }} </td>

                <td></td>
                <td></td>
            </tr>
        </table>

    </div>

