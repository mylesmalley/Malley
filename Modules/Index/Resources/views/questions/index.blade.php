@extends('index::app.main')


@section("content")
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">

			<li class="breadcrumb-item active">Questions</li>
		</ol>
	</nav>

	<h2>
		Question Chain
	</h2>



		@each('questions.partials.list', $tree, 'q')





@endsection
