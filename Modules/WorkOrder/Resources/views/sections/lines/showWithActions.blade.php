<tr>
    <td>{{ $line->quantity }}</td>
    <td>{{ $line->part_number }}</td>
    <td>{{ $line->description }}</td>
    <td class="text-right">
        <a class="btn btn-sm btn-primary" href="{{ url("/workOrders/{$workOrder->id}/editLine/{$line->id}") }}">&#9874;</a>
        <a class="btn btn-sm btn-success" href="{{ url("/workOrders/{$workOrder->id}/addAfter/{$line->order}") }}">+</a>
    </td>
</tr>
