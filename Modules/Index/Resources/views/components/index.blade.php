@extends('index::app.main')

@section("content")
	<div class='breadcrumbs'>
		<a href="{{ url('basevan' ) }}">Platforms</a> /
		<a href="{{ url('basevan/'.$option->base_van->id) }}">{{ $option->base_van->name }}</a> /
		<a href="{{ url('option/'.$option->id ) }}">{{ $option->name }}</a> /
		Components
	</div>

	<h1>{{ $option->name }} {{ $option->description }}  </h1>

	<table style="border:1px solid black">
		<thead>
			<tr>
	        	<th>Sub<br />Assy</th>
	        	<th>Stock<br /> Code</th>
	        	<th>Description</th>
	        	<th>Part<br /> Category</th>
	        	<th>Material</th>
	        	<th>Labor</th>
	        	<th>Unit<br /> Of<br /> Measure</th>
	       		<th>Cost</th>
	        	<th>Rev</th>
	        	<th>Item<br /> Code</th>
	        	<th>Where<br /> Built<br /> Location</th>
	        	<th>Install<br /> Area</th>
	        	<th>Notes</th>
        	</tr>
		</thead>
		<tbody>

			@foreach($option->components as $component)
				<tr>
		        	<td>{{ $component->sub_assembly }}</td>
		        	<td>{{ $component->stock_code }}</td>
		        	<td>{{ $component->description }}</td>
		        	<td>{{ $component->part_category }}</td>
		        	<td>{{ $component->material }}</td>
		        	<td>{{ $component->labour }}</td>
		        	<td>{{ $component->unit_of_measure }}</td>
		        	<td>{{ $component->cost }}</td>
		        	<td>{{ $component->revision }}</td>
		        	<td>{{ $component->item_code }}</td>
		        	<td>{{ $component->where_built_location }}</td>
		        	<td>{{ $component->install_area }}</td>
		        	<td>{{ $component->notes }}</td>
	        	</tr>
			@endforeach
		</tbody>
	</table>
	<a href="{{ url('option/'.$option->id.'/component') }}">[ Add ]</a>
@endsection
