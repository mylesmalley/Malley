<form action="{{ url("/workOrders/{$workOrder->id}/details") }}"
      name="detailsForm"
      id="detailsForm"
      method="POST">
    {{ method_field("PATCH") }}
    {{ csrf_field() }}
</form>
<h2>Details

    @if ( $mode === "details")
        <input type="submit" form="detailsForm" class='btn btn-primary float-right' value="Save">
    @elseif( $mode === "show" )
        <a href="{{ url("workOrders/{$workOrder->id}/details") }}" class='btn btn-info float-right'>Edit</a>
    @else

    @endif

</h2>
<div class="card border-primary document-content-wrapper">

<table class="table table-sm">
    <thead class="bg-secondary text-white">
    <tr>
        <th>Date</th>
{{--        <th>Title</th>--}}
        <th>Work Order Number</th>
        <th>Type</th>
    </tr>
    </thead>
    <tbody>
    @if ( $mode === "details")
        @php
            $types = [
                "" => "WORK ORDER",
                "MRP" => "MOBILITY REPAIR WORK ORDER",
                "ARP" => "AMBULANCE REPAIR WORK ORDER",
                "WAR" => "WARRANTY REPAIR WORK ORDER",
                "SRP" => "SERVICE REPAIR WORK ORDER",
            ];
        @endphp
        <tr>
            <td>
                <input name="date" id="date"
                       class="form-control"
                       aria-label=""
                       form="detailsForm"
                       type="date"
                       value="{{ old('date', $workOrder->date ) ?? date('Y-m-d') }}">
            </td>
{{--            <td>--}}
{{--                <select class="form-control"--}}
{{--                        name="title"--}}
{{--                        aria-label=""--}}
{{--                        id="title"--}}
{{--                        form="detailsForm">--}}
{{--                    @foreach( $titles as $title )--}}
{{--                        <option value="{{ $title }}"--}}
{{--                            {{ old('title', $workOrder->title) === $title ? "selected" : "" }}--}}
{{--                        >{{ $title }}</option>--}}
{{--                        @endforeach--}}
{{--                </select>--}}
{{--            </td>--}}
            <td>
                <input name="number" id="number"
                       class="form-control"
                       aria-label=""
                       form="detailsForm"
                       type="text"
                       value="{{ old('number', $workOrder->number ) ?? "" }}">
            </td>
            <td>
                <select class="form-control"
                        name="type"
                        aria-label=""
                        id="type"
                        form="detailsForm">
                    @foreach( $types as $k => $v )
                        <option value="{{ $k }}"
                            {{ old('type', $workOrder->type) === $k ? "selected" : "" }}
                        >{{ $v }}</option>
                    @endforeach
                </select>
            </td>
        </tr>
    @else

        <tr>
            <td>{{ $workOrder->date }}</td>
{{--            <td>{{ $workOrder->title }}</td>--}}
            <td>{{ $workOrder->number }}</td>
            <td>{{ $workOrder->type }}</td>
        </tr>
    @endif

    </tbody>
</table>


<table class="table table-sm">
    <thead class="bg-secondary text-white">
      <tr>
            <th>Expected Chassis Delivery Date</th>
            <th>Expected Customer Pickup Date</th>
        </tr>
    </thead>
    <tbody>
    @if ( $mode === "details")

        <tr>
            <td>
                <input name="expected_chassis_delivery_date" id="expected_chassis_delivery_date"
                       class="form-control"
                       aria-label=""
                       form="detailsForm"
                       type="date"
                       value="{{ old('expected_chassis_delivery_date', $workOrder->expected_chassis_delivery_date ) ?? date('Y-m-d') }}">
            </td>
            <td>
                <input name="expected_customer_pickup_date" id="expected_customer_pickup_date"
                       class="form-control"
                       aria-label=""
                       form="detailsForm"
                       type="date"
                       value="{{ old('expected_customer_pickup_date', $workOrder->expected_customer_pickup_date ) ?? date('Y-m-d') }}">
            </td>
        </tr>

        @else

            <tr>
                <td>{{ $workOrder->expected_chassis_delivery_date }}</td>
                <td>{{ $workOrder->expected_customer_pickup_date }}</td>
            </tr>
        @endif

    </tbody>
</table>



<table class="table table-sm">
    <thead class="bg-secondary text-white">
    <tr>
        <th>Quote Number</th>
        <th>Purchase Order Number</th>
    </tr>
    </thead>
    <tbody>
    @if ( $mode === "details")
        <tr>
            <td>
                <input name="quote_number" id="quote_number"
                       class="form-control"
                       aria-label=""
                       form="detailsForm"
                       type="text"
                       value="{{ old('quote_number', $workOrder->quote_number ) ?? "" }}">
            </td>
            <td>
                <input name="purchase_order_number" id="purchase_order_number"
                       class="form-control"
                       aria-label=""
                       form="detailsForm"
                       type="text"
                       value="{{ old('purchase_order_number', $workOrder->purchase_order_number ) ?? "" }}">
            </td>
        </tr>
    @else

        <tr>
            <td>{{ $workOrder->quote_number }}</td>
            <td>{{ $workOrder->purchase_order_number }}</td>
        </tr>
    @endif

    </tbody>
</table>
</div>
