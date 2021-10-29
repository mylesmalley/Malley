@php
    $dates = App\Models\Vehicle::dateFields();
@endphp


@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">Edit Dates</h1>
<h2 class="text-center text-secondary">              For {{ $vehicle->identifier }}</h2>


    @includeIf('vehicles::errors')
    <div class="card border-primary document-content-wrapper">
        <div class="card-body">
    <form method="POST" action="{{ url('vehicles/'.$vehicle->id .'/dates') }}">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Field</th>
                    <th class="text-right">Date</th>
                    <th>Notes</th>
                </tr>
            </thead>
            <tbody>
        @foreach( $dates as $date)
            @php
                $notes = "{$date}_notes";
            @endphp
            <tr>
                <td class="text-right align-middle">
                    <label for="{{ $date }}">
                    {{ str_replace( 'Date ','', ucwords( str_replace('_', ' ', $date )) ) }} Date
                    </label>
                </td>
                <td>
                    {{ $vehicle->{$date} ? \Carbon\Carbon::create( $vehicle->{$date} )->format('Y-m-d\TH:i') : "" }}
                    <input type="datetime-local"
                           class="form-control form-control-lg"
                           name="{{ $date }}"
                           id="{{ $date }}"
                           value="{{ old( $date ) ?? ($vehicle->{$date} ? \Carbon\Carbon::create( $vehicle->{$date} )->format('Y-m-d\TH:i') : "")  }}" >
                </td>

{{--                <td>--}}
{{--                    <input type="date"--}}
{{--                           class="form-control form-control-lg"--}}
{{--                           name="{{ $date }}"--}}
{{--                           id="{{ $date }}"--}}
{{--                           value="{{ old( $date ) ?? $vehicle->{$date} ?? '' }}" >--}}
{{--                </td>--}}
                <td>
                    <input type="text"
                           aria-label="{{ $notes }}"
                           class="form-control form-control-lg"
                           name="{{ $notes }}"
                           id="{{ $notes }}"
                           value="{{ old( $notes ) ?? $vehicle->{$notes} ?? '' }}" >
                </td>
            </tr>

            @endforeach
            </tbody>
        </table>

        <div class="row">
            <div class="col-md-12">
                <input type="submit" value="Save Changes" class="btn btn-primary">
            </div>
        </div>
    </form>
        </div>
    </div>
@endsection

