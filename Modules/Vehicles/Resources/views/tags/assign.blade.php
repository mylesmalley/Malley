@extends('vehicles::layout')

@section('content')

    <h1 class="text-center">
        Tags for <a href="{{ url("/vehicles/{$vehicle->id}") }}">{{ $vehicle->identifier }}</a>

    </h1>

    <p>
        To add a tag to a vehicle, just click on it's name from the list below. Tags that are already assigned are coloured green. Contact Myles if you want additional tags added.
    </p>

    @includeIf('vehicles::errors')


    <div class="card border-primary document-content-wrapper">
        <div class="card-body">


    @foreach( $availableTags as $tag )
            <span>
        @if( array_key_exists( $tag->id, $vehicleTags ))

            <form method="POST"
                  style="display:inline;"
                  action="{{ url('/vehicles/'.$vehicle->id.'/tag/'.$tag->id) }}">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <input type="submit" class="btn btn-success" value="{{ $tag->name }}">
            </form>
        @else
            <form method="POST"
                  style="display:inline;"
                  action="{{ url('/vehicles/'.$vehicle->id.'/tag/'.$tag->id) }}">
                {{ csrf_field() }}
                <input type="submit" class="btn btn-outline-success" value="{{ $tag->name }}">
            </form>

        @endif
        </span>
    @endforeach
        </div>

    </div>
@endsection
