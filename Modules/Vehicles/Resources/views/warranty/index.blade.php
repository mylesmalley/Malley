@extends('vehicles::layout')

@section('content')



    <div class="row">
        <div class="col-12 text-center">
            <h1>All Warranty Claims</h1>
        </div>
    </div>
    <br>
    {{ $claims->links() }}

    <div class="row">
        <div class="card border-primary">
            <table class="table table-striped tabble-sm table-hover">
                <thead>
                    <tr>
{{--                        <th>ID</th>--}}
                        <th>VIN</th>
                        <th>Work Order</th>
                        <th>Name</th>
                        <th>Issue</th>
                        <th>Date</th>
                        <th>Notes</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach( $claims as $claim )
                        <tr >
                            <td>
                                @if ( $claim->vehicle )

                                    <a href="{{ url('/vehicles/'.$claim->vehicle_id) }}">
                                        {{ $claim->vin  }}</a>
                                @else
                                    {{ $claim->vin  }}
                            @endif
                                      </td>

                            <td>
                                @if ( $claim->vehicle )
                                    <a href="{{ url('/vehicles/'.$claim->vehicle_id.'/warrantyClaim/'.$claim->id ) }}">
                                    {{ $claim->vehicle->identifier }}</a>
                                @else
                                    Couldn't match to vehicle
                            @endif
                            </td>
                            <td>  {{ $claim->first_name . ' ' . $claim->last_name }} </td>
                            <td>  {{ $claim->issue  }}  </td>
                            <td>{{ $claim->date }}</td>
                            <td>{{ $claim->notes }}</td>
                        </tr>
                        @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{ $claims->links() }}

@endsection

