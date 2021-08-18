
{{--{{ $idsForTickets ?? 'none' }}--}}
@if ( isset ( $idsForTickets )  )
    @if ( $idsForTickets->count() > 999 )
        Too many items selected to print tickets
    @else
        <div class="row">
            <div class="col-3">
                <form method="POST" action="{{ url('/syspro/inventory/'.$inventory->id.'/tickets') }}">
                    {{ csrf_field() }}

                    @foreach( $idsForTickets as $id)
                        <input type="hidden"
                               readonly
                               name="id[]"
                               value="{{ $id }}" >
                    @endforeach
                    <input type="submit" class="btn btn-info btn-lg" value="Generate Tickets" >
                </form>
            </div>

            <div class="col-3">
                <form method="POST" action="{{ url('/syspro/inventory/'.$inventory->id.'/ticketsByBin') }}">
                    {{ csrf_field() }}

                    @foreach( $idsForTickets as $id)
                        <input type="hidden"
                               readonly
                               name="id[]"
                               value="{{ $id }}" >
                    @endforeach
                    <input type="submit" class="btn btn-primary btn-lg" value="Generate Tickets Groupd By Bin" >
                </form>

            </div>
        </div>




    @endif
@endif

<table class="table table-sm table-striped">
    <thead>
    <tr>
        <th>T#</th>
        <th>Stock Code</th>
        <th>Description</th>
        <th>Bin</th>
        <th>Group</th>
        <th>Locale</th>
        <th>Warehouse</th>
        <th>UoM</th>
        <td>
            Status
        </td>
        <th></th>
    </tr>
    </thead>
    <tbody>
    @forelse( $items as $item )
        <tr>
            <td>{{ str_pad($item->ticket_number ?? "NEW", 4, "0", STR_PAD_LEFT)  }}</td>
            <td>
                <a href="{{ url('syspro/inventory/'.$inventory->id.'/search/stock_code/for/'.$item->stock_code) }}"
                >{{ $item->stock_code }}</a>
            </td>
            <td>{{ $item->description_1 }}
                @if ( $item->description_2 )
                    <br>
                    {{ $item->description_2 }}
                @endif
            </td>
            <td>
                <a href="{{ url('syspro/inventory/'.$inventory->id.'/search/bin/for/'.$item->bin) }}"
                >{{ $item->bin }}</a>
            </td>
            <td>
                <a href="{{ url('syspro/inventory/'.$inventory->id.'/search/group/for/'.$item->group ) }}"
                >{{ $item->group }}</a>
            </td>
            <td>
                <a href="{{ url('syspro/inventory/'.$inventory->id.'/search/locale/for/'.$item->locale) }}"
                >{{ $item->locale }}</a>
            </td>
            <td>
                <a href="{{ url('syspro/inventory/'.$inventory->id.'/search/warehouse/for/'.$item->warehouse ) }}"
                >{{ $item->warehouse }}</a>
            </td>
            <td>{{ $item->unit_of_measure }} </td>
            <td
                @switch ( $item->line_status)
                    @case('Matched')
                        class="bg-success text-white"
                        @break
                        @case('Accepted')
                        class="bg-success text-white"
                @break
                    @case('Needs Recount')
                        class="bg-danger text-white"
                    @break
                @case('Not Counted')
                class="bg-warning text-white"
                @break

                    @default
                class="bg-secondary text-white"

                        @break
                @endswitch
            >
                {{ $item->line_status }}
            </td>


            <td>
                <a href="{{ url('syspro/inventory/'.$inventory->id.'/items/'.$item->id) }}"
                   class="btn btn-primary">Open Item</a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="10">No counts yet!</td>
        </tr>
    @endforelse
    </tbody>
</table>

@if ( $items instanceof \Illuminate\Pagination\LengthAwarePaginator )
{{ $items->links() }}

@endif
