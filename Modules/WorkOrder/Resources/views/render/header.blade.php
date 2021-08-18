<table>
    <tr>
        <td>
            {{ $workOrder->date ?? "_DATE_" }}<br>
            {{ $workOrder->user->first_name }} {{ $workOrder->user->last_name }}
        </td>
        <td style="text-align: center; ">
            <h2>
                {{ $workOrder->title }}
            </h2>
        </td>
        <td>
            {{ $workOrder->number ?? "_NUMBER_" }}
        </td>
    </tr>
</table>
<table>
    <thead>
        <tr>
            <th>Vehicle</th>
            <th>Customer</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <td>
                @includeIf('workorder::render.parts.vehicle')
            </td>
            <td>
                @includeIf('workorder::render.parts.customer')
            </td>
        </tr>
    </tbody>

</table>
<table>
    <tr>
        <td>PO# {{ $workOrder->purchase_order_number ?? "_PO_NUMBER_" }}</td>
        <td>Quote# {{ $workOrder->quote_number ?? "_QUOTE_NUMBER_" }}</td>
        <td>Chassis Delivery {{ $workOrder->expected_chassis_delivery_date ?? "_CHASSIS_DATE_" }}</td>
        <td>Customer Pickup {{ $workOrder->expected_customer_pickup_date ?? "_PICKUP_DATE_" }}</td>

    </tr>
</table>
