@extends('vehicles::layout')

@section('content')



    <h1 class="text-center">
         {{ ucwords( str_replace('_', ' ', $date->name ) ) }} Date<br>
        for  <a href="{{ route('vehicle.home', [$vehicle]) }}">{{ $vehicle->identifier }}</a>
    </h1>

    <div class="card border-primary document-content-wrapper">

        <table class="table table-striped">
            <thead class="bg-primary text-white">
            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Notes</th>
            </tr>
            </thead>
            <tbody>
             <tr>
                    <th role="row">
                        {{ ucwords( str_replace('_', ' ', $date->name ) ) }}
                    </th>
                    <td>
                        {{ \Carbon\Carbon::create($date->timestamp)->format('Y-m-d') }}
                    </td>
                    <td>
                        {{ $date->notes }}
                    </td>
                </tr>
            </tbody>
        </table>

    </div>


@endsection


