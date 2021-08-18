<table class="header">

<tr>
        <td colspan="7">

            <span style="font-size: 18pt; font-weight: bold;">
                @switch( $workOrder->type )
                    @case('ARP')
                            AMBULANCE REPAIR WORK ORDER
                        @break
                    @case("SRP")
                        SERVICE REPAIR WORK ORDER
                        @break
                    @case("MRP")
                        MOBILITY REPAIR WORK ORDER
                        @break
                    @case("WAR")
                        WARRANTY REPAIR WORK ORDER
                        @break
                    @default
                    WORK ORDER
                @endswitch

            </span>
        </td>

        <td>
            <span style="font-size: 18pt; font-weight: bold;">

                #{!! $workOrder->number ?? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" !!}
{{--            {{ $workOrder->type }} {{ $workOrder->number ?? "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;" }}--}}
            </span>
        </td>
    </tr>
</table>
<table class="header">


    <!--  LINE 2 -->
    <tr>
        <td>Date</td>
        <td class="data"> {{ $workOrder->date }}</td>
        <td> Customer</td>
        <td class="data" colspan="">{{ $workOrder->customer_name }}</td>
        <td colspan=""> Salesperson</td>
        <td  class="data" colspan=""> {{ Auth::user()->first_name . " " . Auth::user()->last_name }}</td>
    </tr>

</table>
<table class="header">

    <!--  LINE 3 -->
    <tr>

        <td>Address</td>
        <td  class="data" colspan="3">{{ $workOrder->customer_address_1 }}
            @if( $workOrder->customer_address_2 )
                <br>
                {{ $workOrder->customer_address_2 }}
                @endif
        </td>
        <td>City</td>
        <td  class="data">  {{ $workOrder->customer_city }}  </td>
        <td>Prov</td>
        <td  class="data">  {{ $workOrder->customer_province }}  </td>
        <td>Postal</td>
        <td  class="data">  {{ $workOrder->customer_postalcode }}  </td>

    </tr>


</table>



<table class="header">

    <!--  LINE 3 -->
    <tr>
        <td>Contact</td>
        <td  class="data">  {{ $workOrder->customer_contact }}  </td>
        <td>Phone</td>
        <td  class="data" >{{ $workOrder->customer_phone }}

        </td>

        <td>Email</td>
        <td  class="data">  {{ $workOrder->customer_email }}  </td>
        <td>PO#</td>
        <td  class="data">  {{ $workOrder->purchase_order_number }}  </td>


    </tr>


</table>


<table class="header">

    <!--  LINE 3 -->
    <tr>
        <td>VIN</td>
        <td  class="data">{{ $workOrder->vehicle->vin ?? '' }}</td>
        <td>Odometer</td>
        <td  class="data">{!!   $workOrder->odometer != 0 ? $workOrder->odometer : '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' !!}</td>

        <td>Make</td>
        <td  class="data">{{ $workOrder->vehicle->make ?? '' }}</td>

        <td>Model</td>
        <td  class="data">{{ $workOrder->vehicle->model ?? '' }}</td>

        <td>Year</td>
        <td  class="data">{{ $workOrder->vehicle->year ?? '' }}</td>


    </tr>


</table>

<table class="header">

    <!--  LINE 3 -->
    <tr>
        <td>Original WO#</td>


        {{-- NO VEHICLE --}}
        @if( $workOrder->vehicle->id === 3086)
            <td  class="data"> </td>

            @else
        <td  class="data">{{ $workOrder->vehicle->identifier ?? "" }}</td>

    @endif
        <td>Chassis Delivery </td>
        <td  class="data">{{ $workOrder->expected_chassis_delivery_date ?? "" }}</td>

        <td>Customer Pickup</td>

        <td  class="data">{{ $workOrder->expected_customer_pickup_date ?? "" }}</td>


    </tr>


</table>

