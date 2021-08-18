@extends('index::app.main')

@section("content")

	<h1>{{ $al->name }}</h1>
	<p>
	@if( count( $al->ancestors) )

		@foreach( $al->ancestors as $ancestor )
			<a href="/albums/{{ $ancestor->id }}">{{ $ancestor->name }}</a>	&gt;
		@endforeach
		{{ $al->name }}
	@endif
	</p>
	<hr />
	<br />

	<h2>Photos<a href="/albums/{{$al->id}}" class="btn btn-secondary float-right">BACK</a></h2>

	<form method="POST" action="/albums/move">
		{{ csrf_field() }}
		<input type="hidden" name="old_album" value="{{ $al->id }}" />
	@foreach( $al->media as $image )
		<div style="display:inline-block; border: 1px solid gray; padding: 5px;">
			<img width="150" src="{{ $image->cdnURL('thumb') }}"  /><br />
			<input type="checkbox" name="ids[]" value="{{ $image->id }}" />
		</div>
	@endforeach

	<br />
		<h3>Move To: (album ID number)</h3>
	<input type="number" id="album" name="new_album">

{{--		@each('albums.partials.menu', $tree, 'album')--}}

{{--	</input>--}}
		<br />

		<input type="submit" value="Move" />
	</form>
	<br />


@endsection
