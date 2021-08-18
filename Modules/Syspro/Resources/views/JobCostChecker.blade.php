@extends('syspro::template')

@section('content')
    <form method="get" class="form form-wrapper" action="{{ url('syspro/JobCostChecker') }}">
        <div class="row">
            <div class="col-md-4">
                <input type="text"
                       class="form-control"
                       name="jobCode" value="{{ $parent->Job ?? '' }}">
            </div>
            <div class="col-md-3">
                <input class="form-control btn btn-primary"
                       type="submit">
            </div>

         </div>

    </form>
    @if (!is_null($parent ))
    <h1>Closed Job Review for {{ $parent->Job }}</h1>

    <table class="table table-striped table-sm">
        <tbody>
            <tr>
                <td>Job</td>
                <td>{{ $parent->Job }}</td>
                <td>Description</td>
                <td>{{ $parent->JobDescription }}</td>
            </tr>
            <tr>
                <td>Cost Expected</td>
                <td>{{ $parent->CostExpected }}</td>
                <td>Cost Issued</td>
                <td>{{ $parent->CostIssued }}</td>
            </tr>
            <tr>
                <td>Can Be Issued</td>
                <td>{{ $parent->CanBeIssued }}</td>
                <td>Cannot Be Issued</td>
                <td>{{ $parent->CannotBeIssued }}</td>
            </tr>
        </tbody>
    </table>

    <h2>Components</h2>
    <table class="table table-striped table-sm">
        <thead>
            <tr>
                <th>Stock Code &amp; Description</th>
                <th>Required</th>
                <th>Issued</th>
                <th>On Order</th>
                <th>Price</th>
                <th>Cost</th>
                <th>Default<br />Bin</th>
                <th>Status Message</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $children as $child)
                <tr>
                    <td>{{ $child->StockCode }}<br />
                        {{ $child->StockDescription }}</td>
                    <td>{{ $child->Required }}</td>
                    <td>{{ $child->Issued }}</td>
                    <td>{{ $child->OnOrder }}</td>
                    <td>{{ $child->Price }}</td>
                    <td>{{ $child->Cost }}</td>
                    <td>{{ $child->DefaultBin }}</td>
                    <td>{{ $child->Status }}
                        {!!  $child->Status ? "<br />" : "" !!}
                        {{ $child->ErrorWarningMessage }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @else
        Enter a job to start.
    @endif
@endsection
