@extends('index::app.main')

@section("content")

		<nav aria-label="breadcrumb" role="navigation">
			<ol class="breadcrumb">
				<li class="breadcrumb-item active">Platforms</li>
			</ol>
		</nav>

	<h1>Platforms</h1>
	<table class='table table-striped table-hover'>
		@foreach($basevans as $basevan)
			<tr>
				<td onclick="window.location = '{{ url('public/'.$basevan->id) }}'; ">
					{{ $basevan->name }}
				</td>
			</tr>
		@endforeach
	</table>
@endsection
