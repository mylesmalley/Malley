<form action="{{ url("/workOrders/{$workOrder->id}/formatting") }}"
      name="formattingForm"
      id="formattingForm"
      method="POST">
    {{ method_field("PATCH") }}
    {{ csrf_field() }}
</form>
<h2>Formatting

    @if ( $mode === "formatting")
        <input type="submit" form="formattingForm" class='btn btn-primary float-right' value="Save">
    @elseif( $mode === "show" )
        <a href="{{ url("workOrders/{$workOrder->id}/formatting") }}" class='btn btn-info float-right'>Edit</a>
    @else

    @endif

</h2>
<div class="card border-primary document-content-wrapper">

<table class="table table-sm">
    <thead>
    <tr>
        <th>Number of detail lines</th>
        <td></td>
    </tr>
    </thead>
    <tbody>
    @if ( $mode === "formatting")
        <tr>
            <td>
                <input name="linecount" id="linecount"
                       class="form-control"
                       aria-label=""
                       form="formattingForm"
                       type="number"
                       value="{{ old('date', $workOrder->linecount ) ?? 18 }}">
            </td>

        </tr>
    @else

        <tr>
            <td>{{ $workOrder->linecount }}</td>
            <td><small>This number sets how many lines you expect to see on the work order. If you have added 4 lines, it will add blank lines unttil the total reaches this amount. If you have a bunch of long descriptions, this will help you keep the work order from spilling over onto another page. This could also be used to add extra blank pages or lines if needed. </small></td>

        </tr>
    @endif

    </tbody>
</table>
</div>
