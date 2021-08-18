<div class="card border-primary">
    <div class="card-header bg-primary text-white">
        Warranty &amp; Customer Information
        @if( Auth::user()->vbd_modify_finance )
            <a href="{{ url('vehicles/'.$vehicle->id.'/warrantyAndCustomer' ) }}"
               class='btn btn-sm btn-secondary float-end'>Edit Warranty &amp; Customer</a>
        @endif
    </div>

    <div class="card-body">

        @if ( $vehicle->warranty_submitted || $vehicle->customer_name )
            <div class="row">
                <div class="col-md-6">

                    <table class="table table-striped table-sm">
                        <tbody>
                        <tr>
                            <td>Sold By</td>
                            <td>{{ $vehicle->warranty_selling_dealer ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Date Warranty Registered</td>
                            <td>{{ $vehicle->date_warranty_registered ?? '' }}</td>
                        </tr>
                        <tr>
                            <td> Warranty Expiry</td>
                            <td>{{ $vehicle->date_warranty_expiry ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>Date of Purchase</td>
                            <td>{{ $vehicle->date_of_purchase ?? '' }}</td>
                        </tr>
                        <tr>
                            <td>
                                Odometer at Registration
                            </td>
                            <td>{{ $vehicle->warranty_odometer ?? '' }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="col-md-6">
                    <strong>{{ $vehicle->customer_name ?? "" }}</strong><br />
                    @if( $vehicle->customer_address_1 )
                        {{ $vehicle->customer_address_1 }}<br />
                    @endif
                    @if( $vehicle->customer_address_2 )
                        {{ $vehicle->customer_address_2 }}<br />
                    @endif
                    @if( $vehicle->customer_city || $vehicle->customer_province )
                        {{ $vehicle->customer_city ?? "" }} {{ $vehicle->customer_province ?? "" }}<br />
                    @endif
                    @if( $vehicle->customer_postalcode )
                        {{ $vehicle->customer_postalcode }}<br />
                    @endif
                    @if( $vehicle->customer_phone )
                        {{ $vehicle->customer_phone }}<br />
                    @endif
                    @if( $vehicle->customer_email )
                        <a href="mailto:{{ $vehicle->customer_emai }}">{{ $vehicle->customer_email }}</a><br />
                    @endif
                </div>
            </div>

        @else

            <div class="row ">
                <div class="col-md-12 text-center">

                    No warranty has been registered for this van yet.
                </div>

            </div>

        @endif
    </div>

</div>

