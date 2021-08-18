@extends('vehicles::layout')

@php
    $inspection = new App\Models\Inspection;
@endphp

@section('content')
    <div class='row'>
        <div class='col-md-12'>
{{--            <h1 class="display-3">Material Allocation Required for--}}
                <h1 class="display-3">Material Allocation for
                <a href="/vehicles/{{ $vehicle->id}} ">
                    {{ $vehicle->identifier }}
                </a>
            </h1>
        </div>
    </div>

    <table class="table table-striped table-hover table-sm">
        <thead>
            <tr>
                <th> Stock Code </th>
                <th> Description </th>
                <th> Quantity </th>
                <th> Unit of Measure </th>
            </tr>
        </thead>
        <tbody>

    @forelse( $bom as $item )
{{--        @if ($item->Remaining > 0)--}}
        <tr>

            <td>
                <a href="{{ url("syspro/inventoryQuery/".trim($item->StockCode )) }}">
                    {{ $item->StockCode }}</a>
            </td>
            <td> {{ $item->StockDescription }} </td>
{{--            <td> {{ trim( $item->Remaining ) }}  </td>--}}
            <td> {{ (float) trim( $item->QtyIssued ) }}  </td>
            <td> {{ trim( $item->Uom ) }} </td>
        </tr>
{{--        @endif--}}

    @empty
        <tr>
            <td colspan="3"> Nothing </td>
        </tr>
    @endforelse
        </tbody>

    </table>



@endsection
