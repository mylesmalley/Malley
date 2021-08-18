@extends('index::app.main')

@section("content")
		<nav aria-label="breadcrumb" role="navigation">
			<ol class="breadcrumb">
				<li class="breadcrumb-item"><a href="{{ url('public/'.$option->base_van->id) }}">{{ $option->base_van->name }}</a></li>
				<li class="breadcrumb-item"><a href="{{ url('public/option/'.$option->id ) }}">{{ $option->option_name }}</a> </li>
				<li class="breadcrumb-item active">Components</li>
			</ol>
		</nav>

		<h2>{{ $option->option_description }} <a href="{{ url('option/'.$option->id.'/edit') }}" class='btn btn-warning float-right'>Edit</a></h2>

	<table class='table table-striped table-hover'>
		<thead>
			<tr>
	        	<th>Sub<br />Assy</th>
	        	<th>Stock<br /> Code</th>
	        	<th>Description</th>
	        	<th>QTY</th>
	        	<th>Unit<br /> Of<br /> Measure</th>
	        	<th>Where<br /> Built<br /> Location</th>
	        	<th>Install<br /> Area</th>
	        	<th>Notes</th>
	        	<th></th>
        	</tr>
		</thead>
		<tbody>
			@foreach($option->components as $component)
				<tr>
		        	<td>{{ $component->component_sub_assembly }}</td>
		        	<td>{{ $component->component_stock_code }}</td>
		        	<td>{{ $component->component_description }}</td>
		        	<td>{{ $component->component_material_qty }}</td>
		        	<td>{{ $component->component_unit_of_measure }}</td>
		        	<td>{{ $component->component_where_built_location }}</td>
		        	<td>{{ $component->component_install_area }}</td>
		        	<td>{{ $component->component_notes }}</td>
		        	<td><a class='btn btn-info btn-sm' href="{{ url('public/whereUsed/'.$component->component_stock_code) }}">Where Used?</a></td>
	        	</tr>
			@endforeach
		</tbody>
	</table>
@endsection
