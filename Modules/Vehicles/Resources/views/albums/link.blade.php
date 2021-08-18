@extends('vehicles::layout')

@section('content')
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-3">Link Albums To
                <a href="/vehicles/{{ $vehicle->id}} ">
                    {{ $vehicle->identifier }}
                </a>
            </h1>
        </div>
    </div>

{{--    <p>Temporary form for use until I think of a better way. </p>--}}
    @includeIf('vehicles::errors')

    <h2>Link</h2>
    <form method="POST"
          action="/vehicles/{{ $vehicle->id }}/albums">
        {{ csrf_field() }}
                <input type="hidden"
                       id="vehicle_id"
                       name="vehicle_id"
                       readonly
                       required
                       class="form-control"
                       value="{{ old('vehicle_id') ?? $vehicle->id }}"
                >

        <div class="form-row">


            <div class="form-group col-sm-10">
                <label for="album_url">Album URL</label>
                <input type="text"
                       id="album_url"
                       name="album_url"
                       required
                       class="form-control"
                       value="{{ old('album_url') ?? '' }}"
                >
            </div>
        </div>

        <div class="form-row">
            <input type="submit" class="btn btn-primary">
        </div>
    </form>

<br><br>
    <div class='row'>
        <div class='col-md-12'>
            <h1 class="display-5">Already Linked Albums</h1>
        </div>

            <ul>
    @forelse( $vehicle->albums as $album )
        <li>
        @if( count( $album->ancestors) )

            @foreach( $album->ancestors as $ancestor )
                <a href="/albums/{{ $ancestor->id }}">{{ $ancestor->name }}</a>	&gt;
            @endforeach
            {{ $album->name }}
        @endif
            <form method="POST" action="{{ url('/vehicles/'.$vehicle->id.'/albums/'.$album->id ) }}">
                {{ csrf_field() }}
                {{ method_field("DELETE") }}
                <input type="submit" class="btn btn-sm btn-warning" value="Unlink">
            </form>
        </li>
    @empty
      <li>No Albums</li>
        @endforelse

            </ul>
        </div>
    </div>
@endsection
