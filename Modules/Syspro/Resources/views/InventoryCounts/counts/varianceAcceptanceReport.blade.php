@extends('syspro::InventoryCounts.template')

@section('content')

    <h1>Variance Report for  {{ $target }}</h1>

    <a href="{{ url('syspro/inventory/'.$inventory->id) }}"
       class="btn btn-dark btn-lg">Back to the Count</a>


    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>Stock Code</th>
                <th>Bin</th>
                <th>Description</th>
                <th>Group</th>
                <th>Unit Cost</th>
                <th>Locale</th>
                <th>Warehouse</th>
                <th>Supplier</th>
                <th>Catalog</th>
                <th>Expected Qty</th>
                <th>Counted</th>
                <th>Delta</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach( $items as $item )
                <tr>
                    <td>{{ $item->StockCode }}</td>
                    <td>{{ $item->bin }}</td>
                    <td>{{ $item->Description }}</td>
                    <td>{{ $item->group }}</td>
                    <td class="right">{{ $item->UnitCost }}</td>
                    <td>{{ $item->locale }}</td>
                    <td>{{ $item->WHS }}</td>
                    <td>{{ $item->supplier }}</td>
                    <td>{{ $item->Catalog }}</td>
                    <td>{{ $item->ExpectedQty  }}</td>
                    <td>{{ $item->counted }}</td>
                    <td class="">{{ $item->Delta }}</td>
                    <td>
                        <a href="{{ url('syspro/inventory/'.$inventory->id.'/items/'.$item->id) }}"
                           class="btn btn-primary btn-sm">Open </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    @endsection
