<form
    action="{{ url("/workOrders/line") }}"
    method="POST"
    id="firstLine"
    name="firstLine"
>
    {{ csrf_field() }}
    <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">
    <input type="hidden" name="order" value="1">
</form>

<tr>

    <td>
        <input type="text"
               name="quantity"
               form="firstLine"
               class="form-control"
               size="1"
               value="{{ old('quantity') }}"
               aria-label="">
    </td>
    <td>
        <input type="text"
               name="part_number"
               size="4"
               form="firstLine"

               class="form-control"
               value="{{ old('part_number') }}"
               aria-label="">
    </td>
    <td>
        <textarea
            name="description"
            class="form-control"
            form="firstLine"
            aria-label="">{{ old('description') }}</textarea>
    </td>

    <td class="text-right">
        <input type="submit"  form="firstLine" class="btn btn-sm btn-primary" value="Save">
        <a href="{{ url("workOrders/{$workOrder->id}/lines") }}" class="btn btn-danger">Cancel</a>
    </td>
</tr>
