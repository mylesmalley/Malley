@extends('index::app.main')

@section("content")

	<h1>
		{{ $album->name }} <a href="/albums/{{ $album->id }}/edit" class="btn btn-secondary pull-right">Rename</a>
	</h1>

    @if (\Session::has('success'))
        <div class=" col-6 offset-3 text-white card bg-success">
            {!! \Session::get('success') !!}
        </div>
    @endif

	@if ( $album->media->count() === 0 && $album->children()->count() === 0 )

	<form method="POST"
		  style="display:inline-block;"
		  action="{{ url( "/albums/". $album->id ) }}">
		{{ method_field('DELETE') }}
		{{ csrf_field() }}
		<input type="submit" class="btn btn-danger btn-sm " value="Delete Empty Album">
	</form>

	@endif


	<p>
	@if( count( $album->ancestors) )

		@foreach( $album->ancestors as $ancestor )
			<a href="/albums/{{ $ancestor->id }}">{{ $ancestor->name }}</a>	&gt;
		@endforeach
		{{ $album->name }}
	@endif
	</p>
	<hr />
	<br />

		<h2>Albums
			<a class='btn btn-success float-right' href='/albums/{{ $album->id }}/create'>Add Album</a>
		</h2>
	@if (count( $album->children ) )

		<ul style="list-style-type: none;">
			@foreach( $album->children as $child )
				<li>
					<svg id="i-camera" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
						<path d="M2 8 L 9 8 12 4 20 4 23 8 30 8 30 26 2 26 Z" />
						<circle cx="16" cy="16" r="5" />
					</svg>
					<a href="/albums/{{ $child->id }}">{{ $child->name }}</a>
					{!!  $child->public ? "" : "<span class='badge badge-secondary'>Malley Only</span>" !!}</li>
			@endforeach
		</ul>



	@endif
	<br />
	<h2>Photos <span class=" float-right">
			<a href="/albums/{{$album->id}}/move" class="btn btn-primary">Move Photos</a>
		</span>
	</h2>
{{--<hr>--}}

{{--	--}}



	@includeIf('vehicles::errors')

	<form enctype="multipart/form-data"
		  method="POST"
		  action="{{ url("/albums/{$album->id}/add") }}">
		{{ csrf_field() }}
		<div class="row">
			<div class="col-md-2">
				<h5>Add Photos</h5>
			</div>
			<div class="col-md-5">
				<input
						max="10000"
						name="upload[]"
						multiple
						type="file"
						class="form-control" >
			</div>
			<div class="col-md-3">
				<input type="submit" class="btn btn-primary" value="Upload Photos">
			</div>
		</div>
	</form>

	<hr>

	@foreach( $album->media as $image )
		<div style="display:inline-block;
					border: 1px solid gray;
					padding: 5px;">
			<img width="150" alt="" src="{{ $image->cdnURL('thumb') }}"  /><br />

			<form method="POST"
				  style="display:inline-block;"
				  action="{{ url( "albums/". $album->id . '/' . $image->id . "/delete" ) }}">
				{{ method_field('DELETE') }}
				{{ csrf_field() }}
				<input type="submit" class="btn btn-danger btn-sm " value="Delete">
			</form>

		</div>
{{--		{{ dd( $image->awsURL() ) }}--}}
	@endforeach
	<br />



    @if( ! $album->isRoot() && count( $album->children ) === 0 )

        <div class="card border-primary">
            <div class="card-header bg-primary text-white">
                Move This Album
            </div>

            <div class="card-body">
                <form method="POST"
                      action="{{ url( "/albums/moveAlbum") }}">
                    {{ method_field('POST') }}
                    {{ csrf_field() }}
                    <input type="hidden" value="{{ $album->id }}" name="target_id" id="target_id">
                    <div class="row">

                        <div class="form-group col-5">
                            <label for="destinaton_id">Destination Album ID</label>
                            <input type="number"
                                   required
                                   id="destinaton_id" name="destination_id" class="form-control" >

                        </div>
                        <div class="form-group col-5">

                            <input type="submit" class="btn btn-danger btn-sm " value="Move Album">
                        </div>

                    </div>

                </form>
            </div>


        </div>

    @endif

@endsection
