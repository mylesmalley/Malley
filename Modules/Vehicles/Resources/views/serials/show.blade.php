@extends('vehicles::layout')

@section('content')



    <h1 class="text-center">
        Serials for  <a href="{{ route('vehicle.home', [$vehicle]) }}">{{ $vehicle->identifier }}</a>
    </h1>

    <div class="card border-primary document-content-wrapper">

        <table class="table table-striped">
            <thead class="bg-primary text-white">
            <tr>
                <th>Name</th>
                <th>Serial</th>
            </tr>
            </thead>
            <tbody>

            @forelse( $vehicle->serials as $serial)
                <tr>
                    <th role="row">
                        {{ ucwords( str_replace('_', ' ', $serial->key ) ) }}
                    </th>
                    <td>
                        {{ $serial->value }}
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="100">No serials added for this van... yet!</td>
                </tr>
            @endforelse
            </tbody>
        </table>

    </div>
    <br>
    @includeIf('vehicles::errors')

    <div class="card border-primary">
        <div class="card-header bg-primary text-white">
            Add or update a new Serial for {{ $vehicle->identifier }}
        </div>
        <div class="card-body">

            <form action="{{ route('vehicle.serials.store', [$vehicle]) }}" method="POST">
                @csrf
                <div class="row">
                    <div class="col-3 text-secondary">
                        Pick a serial number type and enter in the value. Hit Save. Entering an existing serial number will overwrite the existing value.
                    </div>
                    <div class="col-3">
                        <label for="key">Name of Serial</label>
                        <select name="key"
                                class="form-control"
                                id="key">
                            @foreach( \App\Models\VehicleSerial::available_serials() as $available_date )
                                <option value="{{ $available_date }}">
                                    {{ ucwords( str_replace('_', ' ', $available_date ) ) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3">
                        <label for="value">Serial #</label>
                        <input id="value"
                               name="value"
                               class="form-control"
                               value="{{ old('value') }}"
                                type="text">
                    </div>





                    <div class="col-1" style="vertical-align: bottom;">
                        <input type="submit" class="btn btn-primary" value="Add or Update">
                    </div>


                </div>

            </form>

        </div>
    </div>


@endsection


