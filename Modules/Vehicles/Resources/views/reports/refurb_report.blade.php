@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Refurb Report</h1>

    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>

                    <th>Vehicle</th>
                    <th>ARF#</th>
                    <th>VIN</th>
                    <th>Returned to Malley</th>
                    <th>Delivered to Customer</th>
                    <th>Refurb Dealer</th>
                    <th>End Customer</th>
{{--                    <th>Make</th>--}}
{{--                    <th>Model</th>--}}
{{--                    <th>Year</th>--}}
{{--                    <th>Location</th>--}}
{{--                    <td>Last Update</td>--}}
{{--                    <td>Checked By</td>--}}
{{--                    <th>On</th>--}}

                </tr>
            </thead>

            <tbody>
                @foreach( $matches as $v )

                    <tr onclick="window.location = '{{ route('vehicle.home', [$v->id]) }}'">
                        <td>{{ $v->malley_number ?? '' }}</td>
                        <td>{{ $v->arf_job_number ?? '' }}</td>
                        <td>{{ $v->vin ?? '' }}</td>
                        <td>
                            @if ( $v->returned_for_refurb )
                                {{ \Carbon\Carbon::parse( $v->returned_for_refurb )->format('Y-m-d') }}
                            @endif
                        </td>
                        <td>
                            @if ( $v->delivered_as_refurb )
                                {{ \Carbon\Carbon::parse( $v->delivered_as_refurb )->format('Y-m-d') }}
                            @else
                                <a class="btn btn-sm btn-secondary"
                                   href="{{ route('vehicle.dates', $v->id) }}">Edit</a>
                            @endif

                        </td>
                        <td>{{ $v->refurb_dealer_name ?? '' }}</td>
                        <td>{{ $v->refurb_customer_name ?? '' }}</td>

{{--                        v.refurb_customer_name,--}}
{{--                        v.refurb_dealer_name,--}}
{{--                        [returned_for_refurb],--}}
{{--                        [delivered_as_refurb]--}}
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection