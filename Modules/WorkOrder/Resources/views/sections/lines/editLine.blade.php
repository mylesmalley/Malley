<tr>
    <td>
        <input type="text"
               name="quantity"
               class="form-control"
               size="1"
               form="editForm"
               value="{{ old('quantity', $line->quantity) }}"
               aria-label="">
    </td>
    <td>
        <input type="text"
               name="part_number"
               size="4"
               form="editForm"
               class="form-control"
               value="{{ old('part_number', $line->part_number) }}"
               aria-label="">
    </td>
    <td>
        <textarea
               name="description"
               form="editForm"
               class="form-control"
               aria-label="">{{ old('description', $line->description) }}</textarea>
    </td>
    <td class="text-right">

        <form
            action="{{ url("/workOrders/line/{$line->id}") }}"
            method="POST"
            id="editForm">
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <input type="submit" class="btn btn-primary" value="Save">
        </form>

        <form action="{{ url("/workOrders/line/{$line->id}") }}"
              method="POST">
            {{ csrf_field() }}
            {{ method_field('DELETE') }}
            <input type="submit" class="btn btn-sm btn-danger" value="Delete">
        </form>

    </td>
</tr>
