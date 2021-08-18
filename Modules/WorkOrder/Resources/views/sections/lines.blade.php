

<h2>Lines


    @if ( $mode === "show")
        <a href="{{ url("workOrders/{$workOrder->id}/lines") }}" class='btn btn-info float-right'>Edit</a>
    @else
        <a href="{{ url("workOrders/{$workOrder->id}/show") }}" class='btn btn-info float-right'>Done</a>

        <a href="{{ url('/syspro/inventoryQuery/search') }}"
           target="_blank"
           class='btn  btn-secondary float-right'>Search Syspro</a>
    @endif
</h2>
<div class="card border-primary document-content-wrapper">

<table class="table table-sm table-striped">
    <thead class="bg-primary text-white">
        <tr>
            <th>Qty </th>
            <th>Part #</th>
            <th>Description</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        {{-- if the mode is to do with lines, follow this path to see how it is handled --}}
        @if(  in_array( $mode, ['lines', 'addAfter','editLine'] ))

            @forelse( $workOrder->lines as $line )
                @if( $mode === 'lines' )
                    {{-- if no other action is selected, show all lines with edit / add buttons --}}
                    @includeIf('workorder::sections.lines.showWithActions')
                @endif
                @if( $mode === 'addAfter')
                    @if( $line->order == $value )
                        {{-- show the edit line for the target row --}}
                        @includeIf('workorder::sections.lines.justShow')
                        @include('workorder::sections.lines.addAfterLine')
                    @else
                        {{-- show the plain row for everything else --}}
                        @includeIf('workorder::sections.lines.justShow')
                    @endif
                @endif
                @if( $mode === 'editLine')
                    @if( $line->id === $value )
                        {{-- show the edit line for the target row --}}
                        @includeIf('workorder::sections.lines.editLine')
                    @else
                        {{-- show the plain row for everything else --}}
                        @includeIf('workorder::sections.lines.justShow')
                    @endif
                @endif
            @empty
                {{-- no lines exist so show teh add first line form --}}
                @includeIf('workorder::sections.lines.addFirst')
            @endforelse
        {{-- the mode is something other than to do with lines, so this just returns plain data --}}
        @else
            @forelse( $workOrder->lines as $line )
                {{-- the work order has lines but isn't in edit mode, so just show the lines as is --}}
                @includeIf('workorder::sections.lines.justShow')
            @empty
                {{-- show an empty row with an indiactor that there are no lines on the job yet --}}
                @includeIf('workorder::sections.lines.noLines')
            @endforelse
        @endif
    </tbody>
</table>





{{--<table class="table table-striped">--}}
{{--    <thead>--}}
{{--        <tr>--}}
{{--            <th>Qty</th>--}}
{{--            <th>Part #</th>--}}
{{--            <th>Description</th>--}}
{{--            <th></th>--}}
{{--        </tr>--}}
{{--    </thead>--}}
{{--    <tbody>--}}

{{--    @forelse( $workOrder->lines as $line )--}}
{{--        @if (  $mode === "lines" && $value === $line->id)--}}
{{--    edit line--}}
{{--                <tr>--}}
{{--                    <td>--}}
{{--                        <input type="text"--}}
{{--                               name="quantity"--}}
{{--                               class="form-control"--}}
{{--                               size="1"--}}
{{--                               form="editForm"--}}

{{--                               value="{{ old('quantity', $line->quantity) }}"--}}
{{--                               aria-label="">--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <input type="text"--}}
{{--                               name="part_number"--}}
{{--                               size="4"--}}
{{--                               form="editForm"--}}

{{--                               class="form-control"--}}
{{--                               value="{{ old('part_number', $line->part_number) }}"--}}
{{--                               aria-label="">--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <textarea--}}
{{--                               name="description"--}}
{{--                               form="editForm"--}}

{{--                               class="form-control"--}}
{{--                               aria-label="">{{ old('description', $line->description) }}</textarea>--}}
{{--                    </td>--}}

{{--                    <td>--}}
{{--                        <form--}}
{{--                            action="{{ url("/workOrders/line/{$line->id}") }}"--}}
{{--                            method="POST"--}}
{{--                            id="editForm">--}}
{{--                            {{ csrf_field() }}--}}
{{--                            {{ method_field('PATCH') }}--}}
{{--                            <input type="submit" class="btn btn-primary" value="Save">--}}
{{--                        </form>--}}
{{--                        <form action="{{ url("/workOrders/line/{$line->id}") }}"--}}
{{--                              method="POST">--}}
{{--                            {{ csrf_field() }}--}}
{{--                            {{ method_field('DELETE') }}--}}
{{--                            <input type="submit" class="btn btn-danger" value="Delete">--}}

{{--                        </form>--}}

{{--                    </td>--}}
{{--                </tr>--}}


{{--        @else--}}
{{--            show line--}}
{{--            <tr>--}}

{{--                <td>{{ $line->quantity }}</td>--}}
{{--                <td>{{ $line->part_number }}</td>--}}
{{--                <td>{{ $line->description }}</td>--}}
{{--                <td>--}}
{{--                    @if ( $mode === 'lines' )--}}
{{--                        <a class="btn btn-primary" href="{{ url("/workOrders/{$workOrder->id}/editLine/{$line->id}") }}">&#9874;</a>--}}
{{--                        <a class="btn btn-success" href="{{ url("/workOrders/{$workOrder->id}/addAfter/{$line->order}") }}">+</a>--}}
{{--                    @endif--}}
{{--                </td>--}}
{{--            </tr>--}}
{{--        @endif--}}




{{--            @if (  $mode === "addAfter" && $value === $line->order)--}}



{{--            <form--}}
{{--                action="{{ url("/workOrders/line") }}"--}}
{{--                method="POST">--}}
{{--                {{ csrf_field() }}--}}
{{--                <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">--}}
{{--                <input type="hidden" name="order" value="{{ $line->order +1 }}">--}}
{{--                <input type="hidden" name="line" value="{{ $line->id }}">--}}
{{--                add after line--}}
{{--                <tr>--}}

{{--                    <td>--}}
{{--                        <input type="text"--}}
{{--                               name="quantity"--}}
{{--                               class="form-control"--}}
{{--                               size="1"--}}
{{--                               value="{{ old('quantity') }}"--}}
{{--                               aria-label="">--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <input type="text"--}}
{{--                               name="part_number"--}}
{{--                               size="4"--}}
{{--                               class="form-control"--}}
{{--                               value="{{ old('part_number') }}"--}}
{{--                               aria-label="">--}}
{{--                    </td>--}}
{{--                    <td>--}}
{{--                        <textarea--}}
{{--                            name="description"--}}
{{--                            class="form-control"--}}
{{--                            aria-label="">{{ old('description') }}</textarea>--}}
{{--                    </td>--}}

{{--                    <td>--}}
{{--                        <input type="submit" class="btn btn-primary" value="Save">--}}
{{--                        <a href="{{ url("workOrders/{$workOrder->id}") }}" class="btn btn-danger">Cancel</a>--}}
{{--                    </td>--}}
{{--                </tr>--}}

{{--            </form>--}}






{{--        @endif--}}



{{--            @empty--}}


{{-- no lines at all so show an empty add form--}}

{{--        <form--}}
{{--            action="{{ url("/workOrders/line") }}"--}}
{{--            method="POST">--}}
{{--            {{ csrf_field() }}--}}
{{--            <input type="hidden" name="work_order_id" value="{{ $workOrder->id }}">--}}
{{--            <input type="hidden" name="order" value="1">--}}
{{--            no lines--}}

{{--            <tr>--}}

{{--                <td>--}}
{{--                    <input type="text"--}}
{{--                           name="quantity"--}}
{{--                           class="form-control"--}}
{{--                           size="1"--}}
{{--                           value="{{ old('quantity') }}"--}}
{{--                           aria-label="">--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                    <input type="text"--}}
{{--                           name="part_number"--}}
{{--                           size="4"--}}
{{--                           class="form-control"--}}
{{--                           value="{{ old('part_number') }}"--}}
{{--                           aria-label="">--}}
{{--                </td>--}}
{{--                <td>--}}
{{--                        <textarea--}}
{{--                            name="description"--}}
{{--                            class="form-control"--}}
{{--                            aria-label="">{{ old('description') }}</textarea>--}}
{{--                </td>--}}

{{--                <td>--}}
{{--                    <input type="submit" class="btn btn-primary" value="Save">--}}
{{--                    <a href="{{ url("workOrders/{$workOrder->id}") }}" class="btn btn-danger">Cancel</a>--}}
{{--                </td>--}}
{{--            </tr>--}}

{{--        </form>--}}











{{--    @endforelse--}}

{{--    </tbody>--}}

{{--</table>--}}
</div>
