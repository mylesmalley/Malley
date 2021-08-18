@extends('index::app.main')

@section("content")
		<nav aria-label="breadcrumb" role="navigation">
			{{--
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('public/'.$option->base_van->id) }}">{{ $option->base_van->name }}</a></li>
				<li class="breadcrumb-item"><a href="{{ url('public/option/'.$option->id ) }}">{{ $option->option_name }}</a> </li>
				<li class="breadcrumb-item active">Components</li>
			</ol>
			--}}
		</nav>

	<h1>{{ $stockCode->component_stock_code }} - {{ $stockCode->component_description }}</h1>

	<table class='table table-striped table-hover'>
		<thead>
			<tr>
	        	<th>QTY</th>
	        	<th>UoM</th>
	        	<th>Option #</th>
	        	<th>Description</th>
	        	<th>Platform</th>
        	</tr>
		</thead>
		<tbody>
			@foreach($whereUsed as $component)
				<tr onclick="window.location = '{{ url('public/option/'.$component->option_id) }}'; ">
		        	<td>{{ $component->component_material_qty }}</td>
		        	<td>{{ $component->component_unit_of_measure }}</td>
		        	<td>{{ $component->option_name }}</td>
		        	<td>{{ $component->option_description }}</td>
		        	<td>{{ $component->base_van }}</td>
	        	</tr>
			@endforeach
		</tbody>
	</table>
@endsection
