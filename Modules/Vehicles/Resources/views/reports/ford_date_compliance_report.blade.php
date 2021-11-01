@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Ford Date Compliance Report</h1>


    <div class="card border-primary">
        <table class="table table-sm table-striped table-hover">
            <thead>
                <tr>
                    <th>Vehicle</th>
                    @foreach( $milestones as $m )
                        <th>{{ ucwords( str_replace('_',' ', $m)) }}</th>
                    @endforeach
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
                            <td>
                                @if ( $r->{$m} == true )
                                    yes
                                @else
                                    x
                                @endif
                            </td>
                        @endforeach
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