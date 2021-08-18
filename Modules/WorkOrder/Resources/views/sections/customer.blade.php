<form action="{{ url("/workOrders/{$workOrder->id}/customer") }}"
      name="custForm"
      id="custForm"
      method="POST">
    {{ method_field("PATCH") }}
    {{ csrf_field() }}
</form>
<h2>Customer

    @if ( $mode === "customer")
        <input type="submit" form="custForm" class='btn btn-primary float-right' value="Save">
    @elseif( $mode === "show" )
        <a href="{{ url("workOrders/{$workOrder->id}/customer") }}" class='btn btn-info float-right'>Edit</a>
    @else

    @endif

</h2>
<div class="card border-primary document-content-wrapper">

<table class="table table-sm">
    <thead class="bg-secondary text-white">
    <tr>
        <th>Name</th>
        <th>Contact Person</th>
        <th>Contact Phone</th>
        <th>Contact Email</th>
    </tr>
    </thead>
    <tbody>
    @if ( $mode === "customer")
        <tr>
            <td>
                <input name="customer_name" id="customer_name"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_name', $workOrder->customer_name ) ?? "" }}">
            </td>
            <td>
                <input name="customer_contact" id="customer_contact"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_contact', $workOrder->customer_contact ) ?? "" }}">
            </td>
            <td>
                <input name="customer_phone" id="customer_phone"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_phone', $workOrder->customer_phone ) ?? "" }}">
            </td>
            <td>
                <input name="customer_email" id="customer_email"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_email', $workOrder->customer_email ) ?? "" }}">
            </td>
        </tr>
    @else

        <tr>
            <td>{{ $workOrder->customer_name }}</td>
            <td>{{ $workOrder->customer_contact }}</td>
            <td>{{ $workOrder->customer_phone }}</td>
            <td>{{ $workOrder->customer_email }}</td>
        </tr>
    @endif

    </tbody>
</table>


<table class="table table-sm">
    <thead class="bg-secondary text-white">
    <tr>
        <th>Address</th>
        <th>City</th>
        <th>Province / State</th>
        <th>Postal / ZIP</th>
    </tr>
    </thead>
    <tbody>
    @if ( $mode === "customer")
        <tr>
            <td>
                <input name="customer_address_1" id="customer_address_1"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_address_1', $workOrder->customer_address_1 ) ?? '' }}"><br>
                <input name="customer_address_2" id="customer_address_2"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_address_2', $workOrder->customer_address_2 ) ?? '' }}">
            </td>

            <td>
                <input name="customer_city" id="customer_city"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_city', $workOrder->customer_city ) ?? '' }}">
            </td>
            <td>
                <input name="customer_province" id="customer_province"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_province', $workOrder->customer_province ) ?? '' }}">
            </td>
            <td>
                <input name="customer_postalcode" id="customer_postalcode"
                       class="form-control"
                       aria-label=""
                       form="custForm"
                       type="text"
                       value="{{ old('customer_postalcode', $workOrder->customer_postalcode ) ?? '' }}">
            </td>
        </tr>
    @else

        <tr>
            <td>{{ $workOrder->customer_address_1 }}<br>
                {{ $workOrder->customer_address_2 }}</td>
            <td>{{ $workOrder->customer_city }}</td>
            <td>{{ $workOrder->customer_province }}</td>
            <td>{{ $workOrder->customer_postalcode }}</td>
        </tr>
    @endif

    </tbody>
</table>
</div>
