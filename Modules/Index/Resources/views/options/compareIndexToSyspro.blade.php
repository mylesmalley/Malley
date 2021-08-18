@extends('index::app.main')

@section("content")
{{--
	<nav aria-label="breadcrumb" role="navigation">
		<ol class="breadcrumb">
			<li class="breadcrumb-item"><a href="{{ url('basevan' ) }}">Platforms</a></li>
			<li class="breadcrumb-item active">{{ $baseVan->name }}</li>
		</ol>
	</nav>
--}}

	<h1>{{ $option->option_description }}</h1>
	<p>Compare the components between the option index (this site) and Syspro's phantom number - {{ $option->option_syspro_phantom }}</p>

	<table class='table table-hover table-striped'>
		<thead class="thead-dark">
			<tr>
				<th>Option Index</th>
				<th>Part Number</th>
				<th>Syspro</th>
			</tr>
		</thead>
		<tbody>
			@foreach($results as $o)
				<tr class="table-{{ $o['class'] }}">
					<td>{{ $o['index'] }}</td>
					<td>{{ $o['code'] }}</td>
					<td>{{ $o['syspro'] }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>
@endsection
