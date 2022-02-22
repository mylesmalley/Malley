@php
 //dd($parts);
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
    <h1 class="text-center">BOM Cost Tool</h1>

    <div class="card border-primary col-8 offset-2">
        <div class="card-body">
            <form method="get" action="{{ url('syspro/BOMCoster') }}">
                <div class="row">
                    <div class="col-3">
                        <label for="stockCode">Enter a Stock Code</label>
                    </div>
                    <div class="col-md-4">
                        <input type="text"
                               id="stockCode"
                               class="form-control"
                               name="stockCode" value="{{ $stockCode ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <input class=" btn btn-primary"
                               value="Search"
                               type="submit">
                    </div>

                </div>

            </form>
        </div>
    </div>
    <br>

    @if ($parts)
{{--    <h1>Closed Job Review for {{ $parent->Job }}</h1>--}}


    <div class="card border-primary col-6 offset-3">
        <div class="card-header bg-primary text-white">
           Breakdown of  {{ $stockCode }}
        </div>


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
    </div>
<br>


        <div class="card border-primary ">
            <div class="card-header bg-primary text-white">
                Components of {{ $stockCode }}

                <a class="btn btn-info btn-sm float-end" href="{{ route("inventory.reports.bom_coster_csv", $stockCode )  }}">Download as TSV</a>

            </div>

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
                            $padding = str_repeat("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;", $part->Level );
                        @endphp
                        <tr>
        {{--                    <td>{{ $part->Level }}</td>--}}
                            <td class="text-nowrap">
                                {{--                                <a href="{{ url('/syspro/BOMCoster').'/'. end( $tree ) }}">{!!  $val !!}</a>--}}
                                {!! $padding !!}
                                <a href="{{ route("inventory.reports.bom_coster", end( $tree ) )  }}">{{  end( $tree ) }}</a>

                            </td>
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
