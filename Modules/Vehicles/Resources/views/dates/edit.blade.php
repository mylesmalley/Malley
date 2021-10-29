@extends('vehicles::layout')

@section('content')



    <h1 class="text-center">
         {{ ucwords( str_replace('_', ' ', $date->name ) ) }} Date<br>
        for  <a href="{{ route('vehicle.home', [$vehicle]) }}">{{ $vehicle->identifier }}</a>
    </h1>

    <div class="card border-primary document-content-wrapper">


        <form action="{{ route('vehicle.date.update', [$vehicle, $date]) }}"
            method="POST">
            @csrf

            <table class="table table-striped">
                <thead class="bg-primary text-white">
                <tr>
                    <th></th>
                    <th>Event</th>
                    <th>Date</th>
                    <th>Notes</th>
                </tr>
                </thead>
                <tbody>
                 <tr>
                     <th role="row">
                         Currently:
                     </th>
                     <td>
                            {{ ucwords( str_replace('_', ' ', $date->name ) ) }}
                     </td>
                        <td>
                            {{ \Carbon\Carbon::create($date->timestamp)->format('Y-m-d') }}
                        </td>
                        <td>
                            {{ $date->notes }}
                        </td>
                    </tr>

                    <tr>
                        <td>
                            Update to:
                        </td>
                        <td>
                            {{ ucwords( str_replace('_', ' ', $date->name ) ) }}
                        </td>
                        <td>
                            <div class="row">
                                <div class="col-6">
                                    <label for="date">Date</label>
                                    <input
                                            id="date"
                                            type="date"
                                            required
                                            name="date"
                                            class="form-control"
                                            value="{{ old('date') ?? \Carbon\Carbon::create($date->timestamp)->format('Y-m-d') }}"
                                    >
                                </div>
                                <div class="col-6">
                                    <label for="time">Time</label>
                                    <input
                                            id="time"
                                            type="time"
                                            required
                                            name="time"
                                            step="60000"
                                            class="form-control"
                                            value="{{ old('time') ?? \Carbon\Carbon::create($date->timestamp)->format('H:i:s') }}"
                                    >
                                </div>
                            </div>

                        </td>
                        <td>
                            <label for="notes">Notes</label>
                            <input id="notes"
                                   name="notes"
                                   value="{{ old('notes', $date->notes ) ?? '' }}"
                                   class="form-control"
                                    type="text">
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="card-footer">
                <div class="row">
                    <div class="col-2 text-start">
                        <a href="{{ route('vehicle.date.delete', [$vehicle, $date ]) }}"
                           class="btn btn-danger">Delete</a>
                    </div>
                    <div class="col-10 text-end">
                        <a href="{{ route('vehicle.dates', [$vehicle ]) }}"
                           class="btn btn-secondary">Discard Changes</a>

                        <input type="submit" class="btn btn-primary " value="Save Changes">

                    </div>
                </div>

            </div>
        </form>

    </div>


@endsection


