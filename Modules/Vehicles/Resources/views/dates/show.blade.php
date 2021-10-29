@extends('vehicles::layout')

@section('content')



    <h1 class="text-center">
        Dates for  <a href="{{ route('vehicle.home', [$vehicle]) }}">{{ $vehicle->identifier }}</a>
    </h1>

    <div class="card border-primary document-content-wrapper">

        <table class="table table-striped">
            <thead class="bg-primary text-white">
            <tr>
                <th>Event</th>
                <th>Date</th>
                <th>Notes</th>
                <th></th>
            </tr>
            </thead>
            <tbody>

                @forelse( $vehicle->dates as $date)
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
                        <td>
                            <a href="{{ route('vehicle.date.edit', [$vehicle, $date ]) }}"
                               class="btn btn-sm btn-success">Change</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="100">No dates added for this van... yet!</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

    </div>
    <br>
    @includeIf('vehicles::errors')

    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            Add a new Date for {{ $vehicle->identifier }}
        </div>
        <div class="card-body">

            <form action="{{ route('vehicle.date.store', [$vehicle]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-3">
                        <label for="name">Name of Event</label>
                        <select name="name"
                                class="form-control"
                                id="name">
                            <option value="arrived">Date Arrived</option>
                        </select>
                    </div>



                    <div class="col-3">
                        <label for="date">Date</label>
                        <input
                            id="date"
                            type="date"
                            required
                            name="date"
                            class="form-control"
                            value="{{ old('date') ?? \Carbon\Carbon::now('America/Moncton')->format('Y-m-d') }}"
                        >
                    </div>


                    <div class="col-2">
                        <label for="time">Time</label>
                        <input
                            id="time"
                            type="time"
                            required
                            name="time"
                            step="60000"
                            class="form-control"
                            value="{{ old('time') ?? \Carbon\Carbon::now('America/Moncton')->format('H:i') }}"
                        >
                    </div>



                    <div class="col-3">

                        <label for="notes">Notes</label>
                        <input id="notes"
                               name="notes"
                               value="{{ old('notes' ) ?? '' }}"
                               class="form-control"
                               type="text">
                    </div>

                    <div class="col-1" style="vertical-align: bottom;">
                        <input type="submit" class="btn btn-primary" value="Add">
                    </div>


                </div>

            </form>

        </div>
    </div>


@endsection


