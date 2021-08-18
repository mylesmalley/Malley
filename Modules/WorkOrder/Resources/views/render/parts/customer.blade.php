<table>
    <tr>
        <td>
            Name
        </td>
        <td>{{ $workOrder->customer_name ?? '' }}</td>
    </tr>
    <tr>
        <td>Address</td>
        <td>
            @if( $workOrder->customer_address_1 )
                {{ $workOrder->customer_address_1 }}<br />
            @endif
            @if( $workOrder->customer_address_2 )
                {{ $workOrder->customer_address_2 }}<br />
            @endif
                {{ $workOrder->customer_city ?? "" }} {{ $workOrder->customer_province ?? "" }}  {{ $workOrder->customer_postalcode ?? "" }}
        </td>
    </tr>
    <tr>
        <td>Contact</td>
        <td> {{ $workOrder->customer_contact ?? "" }}</td>
    </tr>
    <tr>
        <td>Contact Email</td>
        <td>{{ $workOrder->customer_phone ?? "" }}</td>
    </tr>
    <tr>
        <td>Contact Phone</td>
        <td>{{ $workOrder->customer_email ?? "" }}</td>
    </tr>
</table>
