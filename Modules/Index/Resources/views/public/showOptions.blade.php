@extends('index::app.main')

@section("content")
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('public' ) }}">Platforms</a></li>
			<li class="breadcrumb-item active">{{ $baseVan->name }}</li>
		</ol>
	</nav>


	<h1>{{ $baseVan->name }} Options</h1>

	<table class='table table-hover table-striped'>
		<thead class="thead-dark">
			<tr>
				<th>#</th>
				<th>Description</th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach($options as $option)
				<tr onclick="window.location = '{{ url('public/option/'.$option->id) }}'; ">
					<td>{{ $option->option_name }}</td>
					<td>{{ $option->option_description }}</td>
					<td><a href="{{ url('option/'.$option->id.'/edit') }}" class='btn btn-warning'>Edit</a> </td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
