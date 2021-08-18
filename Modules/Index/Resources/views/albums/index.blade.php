@extends('index::app.main')


@section("content")

	<h1>
		Photo Albums
	</h1>

	<ul style="list-style-type: none;">

	@each('index::albums.partials.list', $tree, 'album')
	</ul>

@endsection
