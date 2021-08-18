@php
    $serials = App\Models\Vehicle::serialFields();
@endphp


@extends('vehicles::layout')

@section('content')


    <h1 class="text-center">Edit Serials</h1>
    <h2 class="text-center text-secondary">For {{ $vehicle->identifier }}</h2>


    @includeIf('vehicles::errors')
    <div class="card border-primary document-content-wrapper">
        <div class="card-body">

    <form method="POST" action="{{ url('vehicles/'.$vehicle->id .'/serials') }}">

        {{ csrf_field() }}
        {{ method_field('PATCH') }}

        <table class="table table-striped">
            <thead>
                <tr>
                    <th class="text-right">Field</th>
                    <th>Value</th>
                    <th class="text-right">Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
        @for( $i = 0; $i < count( $serials ) ; $i += 2)
            <tr>
                <td class="text-right align-middle">
                    <label for="{{ $serials[$i] }}">
                    {{ ucwords( str_replace('_', ' ', $serials[$i] ) ) }}
                    </label>
                </td>
                <td>
                    <input type="text"
                           class="form-control form-control-lg"
                           name="{{ $serials[$i] }}"
                           id="{{ $serials[$i] }}"
                           value="{{ old( $serials[$i] ) ?? $vehicle->{$serials[$i]} ?? '' }}" >
                </td>

                @if ( isset(   $serials[ $i +1] ) )

                <td class="text-right align-middle">
                    <label for="{{ $serials[$i+1] }}">
                        {{ ucwords( str_replace('_', ' ', $serials[$i+1] ) ) }}
                    </label>
                </td>
                <td>
                    <input type="text"
                           class="form-control form-control-lg"
                           name="{{ $serials[$i+1] }}"
                           id="{{ $serials[$i+1] }}"
                           value="{{ old( $serials[$i+1] ) ?? $vehicle->{$serials[$i+1]} ?? '' }}" >
                </td>

                @else
                    <td></td>
                @endif
            </tr>

            @endfor
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

