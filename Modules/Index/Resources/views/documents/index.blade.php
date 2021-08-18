@extends('index::app.main')


@section("content")

	<h1>
		Dealer Documents
	</h1>

	@each('documents.partials.list', $tree, 'q')

@endsection
