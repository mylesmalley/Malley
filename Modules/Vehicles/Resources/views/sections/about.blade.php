
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

                <th scope="row">
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        Original Customer <br>
                        Refurb Customer
                    @else
                        Customer
                    @endif
                </th>
                <td>
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        {{ $vehicle->customer_name ?? '' }}<br>
                        {{ $vehicle->refurb_customer_name ?? '' }}
                    @else
                    {{ $vehicle->customer_name ?? '' }}

                        @endif
                </td>

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
                <th scope="row">
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name
                            || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        Original Dealer <br>
                        Refurb Dealer
                    @else
                        Dealer
                    @endif


                </th>
                <td>
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name
                            || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        {{ $vehicle->dealer->name ?? '' }} <br>
                        {{ $vehicle->refurb_dealer_name ?? '' }}
                    @else
                        {{ $vehicle->dealer->name ?? '' }} <br>
                    @endif


                    </td>

                <th scope="row">Roof Height</th>
                <td>{{ $vehicle->roof_height ?? '' }} </td>

                <th  rowspan="2"
                     scope="row"
                >Tags <a href="{{ url("/vehicles/{$vehicle->id}/tags") }}" class="btn btn-sm btn-primary">Edit</a></th>
                <td rowspan="2">
                    @foreach( $vehicle->tags as $tag)
                        <a href="{{ url('vehicles/tags/'.$tag->id ) }}" class="badge bg-dark">{{ $tag->name }}</a>

                    @endforeach
                </td>
            </tr>

            <tr>
                <th scope="row">

                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        Refurb Number
                    @endif

                </th>
                <td>
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        {{ $vehicle->refurb_number ?? '' }}
                    @endif
                </td>

                <th scope="row">Fuel</th>
                <td>{{ $vehicle->fuel ?? '' }} </td>
            </tr>

            <tr>
                <th scope="row">
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name
                            || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        ARF Job Number
                    @endif
                </th>
                <td>
                    @if ( $vehicle->refurb_number || $vehicle->refurb_customer_name
                            || $vehicle->refurb_dealer_name || $vehicle->arf_job_number )
                        {{ $vehicle->arf_job_number ?? '' }}
                    @endif

                </td>

                <th scope="row">Drive</th>
                <td>{{ $vehicle->drive ?? '' }} </td>

                <td></td>
                <td></td>
            </tr>
        </table>

    </div>

