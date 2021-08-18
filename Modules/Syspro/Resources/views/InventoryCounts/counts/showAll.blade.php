@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 >{{ $inventory->description }}</h1>
    <a href="{{ url('syspro/inventory/'.$inventory->id ) }}"
       class="btn btn-secondary">Back to Count Home</a>
    @includeIf('syspro::InventoryCounts.errors')

    <table class="table table-sm table-striped">
        <thead>
        <tr>
            <th>T#</th>
            <th>Stock Code</th>
            <th>Description</th>
            <th>Bin</th>
            <th>Group</th>
            <th>UoM</th>
            <th></th>
        </tr>
        </thead>
        <tbody>
        @forelse( $results as $item )
            <tr>
                <td>{{ $item->ticket_number }}</td>
                <td>{{ $item->stock_code }}</td>
                <td>{{ $item->description_1 }}
                    @if ( $item->description_2 )
                        <br>
                        {{ $item->description_2 }}
                    @endif
                </td>
                <td>{{ $item->bin }} </td>
                <td>{{ $item->group }} </td>
                <td>{{ $item->unit_of_measure }} </td>
{{--                <td>{{ $item->locked ? "Locked" : "" }} </td>--}}
                <td>
                    <a href="{{ url('syspro/inventory/'.$inventory->id.'/items/'.$item->id) }}"
                       class="uk-button uk-button-secondary">Open Item</a>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="3">No counts yet!</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    {{ $results->links() }}

    <a href="{{ url('syspro/inventory/'. $inventory->id.'/items/create') }}"
       class="uk-button uk-button-primary">New Item</a>
@endsection
