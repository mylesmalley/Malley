@php
//    dd($parts);
    // totals
    $labour = 0;
    $materials = 0;

    foreach( $parts as $part)
    {

        if ($part->{"Cost Type"} === "LAB")
        {
            $labour += $part->TotalCost;
        }
        else
        {
            $materials += $part->TotalCost;
        }
    }
@endphp
@extends('syspro::template')

@section('content')
    <h1>BOM Cost Tool</h1>
    <form method="get" class="form form-wrapper" action="{{ url('syspro/BOMCoster') }}">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       class="form-control"
                       name="stockCode" value="{{ $stockCode ?? '' }}">
            </div>
            <div class="col-md-3">
                <input class="form-control btn btn-primary"
                       type="submit">
            </div>

         </div>

    </form>
    @if ($parts)
{{--    <h1>Closed Job Review for {{ $parent->Job }}</h1>--}}

    <h2>Components of {{ $stockCode }}</h2>

<table class="table table-striped">
    <tbody>
    <tr>
        <td>Material</td>
        <td>${{ $materials }}</td>
    </tr>
    <tr>
        <td>Labour</td>
        <td>${{ $labour }}</td>
    </tr>
    <tr>
        <td>Total</td>
        <td>${{ $labour + $materials }}</td>
    </tr>
    </tbody>
</table>

    <table class="table table-striped table-sm">
        <thead>
            <tr>
{{--                <th>Level</th>--}}
                <th>Component</th>
                <th>Description</th>
                <th>Warehouse</th>
                <th>Cost Type</th>
                <th>Unit Qty</th>
                <th>Cost</th>
                <th>Line Total</th>
                <th>Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $parts as $part)
                @php
                    $tree = explode('\\', $part->SRC);
                    $val = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $part->Level ) . end( $tree );
                @endphp
                <tr>
{{--                    <td>{{ $part->Level }}</td>--}}
                    <td class="text-nowrap"> <a href="{{ url('/syspro/BOMCoster').'/'. end( $tree ) }}">{!!  $val !!}</a></td>
                    <td>{{ $part->Description }}</td>
                    <td>{{ $part->Whs }}</td>
                    <td>{{ $part->{"Cost Type"} }}</td>
                    <td>{{ $part->Qty }}</td>
                    <td>{{ $part->Cost }}</td>
                    <td>{{ $part->TotalCost }}</td>

                    <td>{{ $part->MSG }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>


    @else
        Enter a Stock Code to start.
    @endif
@endsection
