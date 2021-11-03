@extends('vehicles::layout')

@section('content')

    <h1 class="text-center"> Date Compliance Report</h1>


    <div class="card border-primary">
        <div class="card-body">
            <p>This report shows all vehicles tracked by the vehicle database that are missing dates.
                The date columns below are the ones required for compliance with our QVM certification.</p>
            <p><a href="{{ route('vehicles.reports.ford_compliance') }}?show_not_here">Show vans not yet here</a>
{{--                <a href="{{ route('vehicles.reports.ford_compliance') }}?show_departed">Show vans have left</a>--}}

            </p>
        </div>
    </div>

    <br>

    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    @foreach( $milestones as $m )
                        <th>{{ ucwords( str_replace('_',' ', $m)) }}</th>
                    @endforeach
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @forelse( $results as $r )
                    <tr>
                        <td>
                            <a href="{{ route('vehicle.home', [$r->id]) }}">
                                {{ $r->year . ' ' . $r->make . ' ' . $r->model }}<br>
                                {{ $r->vin }}<br>
                                {{ $r->customer_name ?? 'No customer name' }}
                            </a>

                        </td>
                        @foreach( $milestones as $m )
                            @if ( $r->{$m} == true )
                                <td class="table-success">
                                    Yes
                                </td>
                            @else
                                <td class="table-danger">
                                    No
                                </td>
                            @endif
                        @endforeach
                        <td>
                            <a href="{{ route('vehicle.dates', [$r->id]) }}" class="btn btn-sm btn-secondary">
                                Edit
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100">No matching vehicles</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>


        @endsection