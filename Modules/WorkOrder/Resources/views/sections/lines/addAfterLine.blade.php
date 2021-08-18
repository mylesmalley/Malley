
<form
    action="{{ url("/workOrders/line") }}"
    name="addAfter"
    id="addAfter"
    method="POST">
    {{ csrf_field() }}
    <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">
    <input type="hidden" name="order" value="{{ $line->order +1 }}">
    <input type="hidden" name="line" value="{{ $line->id }}">
</form>

<tr>

    <td>
        <input type="text"
               name="quantity"
               class="form-control"
               form="addAfter"
               size="1"
               value="{{ old('quantity') }}"
               aria-label="">
    </td>
    <td>
        <input type="text"
               name="part_number"
               size="4"
               form="addAfter"
               class="form-control"
               value="{{ old('part_number') }}"
               aria-label="">
    </td>
    <td>
        <textarea
            name="description"
            form="addAfter"
            class="form-control"
            aria-label="">{{ old('description') }}</textarea>
    </td>

    <td class="text-right">
        <input type="submit" form="addAfter" class="btn btn-sm btn-primary" value="Save">
        <a href="{{ url("workOrders/{$workOrder->id}/lines") }}" class="btn btn-danger">Cancel</a>
    </td>
</tr>


