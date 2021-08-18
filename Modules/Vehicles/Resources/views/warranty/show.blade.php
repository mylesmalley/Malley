@extends('vehicles::layout')

@section('content')
    <div class="panel-heading panel-warning"><h1>
            Claim #{{ $claim->id }}
            <a href="{{ url('vehicles/'.$vehicle->id) }}" class="btn btn-secondary float-right">Back to Vehicle</a>
            <a href="{{ url('warranty') }}" class="btn btn-secondary float-right">Back to All Claims</a>
        </h1>
        <h3>For {{ $vehicle->identifier }}</h3>
    </div>

    @includeIf('vehicles::errors')

    <div class="panel-body">
        <h2>Contact</h2>

        <table class="table table-striped">
            <tr>
                <td>Name</td>
                <td>{{ $claim->first_name }} {{ $claim->last_name }}</td>
            </tr>
            @if ($claim->organization)
                <tr>
                    <td></td>
                    <td>{{ $claim->organization }}</td>
                </tr>
            @endif
            <tr>
                <td>Email</td>
                <td>{{ $claim->email }}</td>
            </tr>
            <tr>
                <td>Phone</td>
                <td>{{ $claim->phone }}</td>
            </tr>
        </table>

        <h2>Vehicle</h2>
        <table class="table table-striped">
            <tr>
                <td>Make</td>
                <td>{{ $claim->year }} {{ $claim->make }} {{ $claim->model }}</td>
            </tr>
            <tr>
                <td>VIN</td>
                <td>{{ $claim->vin }}</td>
            </tr>
            <tr>
                <td>Mileage</td>
                <td>{{ $claim->mileage }}</td>
            </tr>

        </table>

        <h2>Issue</h2>
        <table class="table table-striped">
            <tr>
                <td>Date</td>
                <td>{{ $claim->date }}</td>
            </tr>
            <tr>
                <td>Issue</td>
                <td><p>{{ $claim->issue }}</p></td>
            </tr>
        </table>


        <h2>Documentation</h2>
        @if ( $claim->media && count($claim->media) > 0)
            <table class="table table-striped">

                @foreach( $claim->media as $media)
                    {{--                    <tr>--}}
                    {{--                        <td>{{ $loop->index + 1 }}</td>--}}
                    {{--                        <td><a href="https://blueprint.malleyindustries.com/media/{{ $media->id }}">{{ $media->file_name }}</a></td>--}}
                    {{--                    </tr>--}}
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td><a href="{{ $media->cdnURL() }}">{{ $media->file_name }}</a></td>
                    </tr>
                @endforeach
            </table>

        @else
            No supporting photos or documents submitted.
        @endif


        <h2>Notes</h2>
        <form method="POST" action="{{ url("vehicles/{$vehicle->id}/warrantyClaim/{$claim->id}") }}">
            {{ method_field('PATCH') }}
            {{ csrf_field() }}
            <textarea class="form-control"
                      id="notes"
                      name="notes"
                      aria-label="notes">{{ old('notes') ?? $claim->notes ?? "" }}</textarea>
            <br>
            <input type="submit" value="Save Notes" class="btn btn-primary">

        </form>
        <br> <br>
    </div>
@endsection
