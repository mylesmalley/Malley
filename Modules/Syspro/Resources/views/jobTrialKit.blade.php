@extends('syspro::template')

@section('content')
    <h1>Job Trial Kit Report</h1>
    <p>Highlighted stock codes are duplicates.</p>
    <form method="get" class="form form-wrapper" action="{{ route('JobTrialKit') }}">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       aria-label=""
                       class="form-control"
                       name="jobCode" value="{{ $parent ?? '' }}">
            </div>
            <div class="col-md-3">
                <input class="form-control btn btn-primary"
                       type="submit">
            </div>

         </div>

    </form>
    @if (!is_null($parent ))

    <h2>Components for {{ $parent }}</h2>
    <table class="table table-striped table-sm table-hover">
        <thead>
            <tr>
                <th>Stock Code &amp; Description</th>
                <th>Description</th>
                <th>Phantom Parent</th>
                <th>Phantom Desc</th>
                <th>QTY Req'd</th>
                <th>Cost Per</th>
                <th>Cost Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $children as $child)
                <tr>
                    <td
                        @if ( in_array( trim($child->StockCode),  $duplicates ))
                            class="bg-warning"
                            @endif


                    ><a href="{{ route('stock_code_query', [$child->StockCode]) }}">{{ $child->StockCode }}</a></td>
                    <td>{{ $child->Description }}</td>
                    <td><a href="{{ route('stock_code_query', [$child->PhantomParent]) }}">{{ $child->PhantomParent }}</a></td>
                    <td>{{ $child->{"Phantom Desc"} }}</td>
                    <td>{{ $child->{"Qty Req'd"} }}</td>
                    <td>{{ $child->{"Cost Per"} }}</td>
                    <td>{{ $child->{"Cost Total"} }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        Enter a job to start.
    @endif
@endsection
