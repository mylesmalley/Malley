<h1>{{ $stockCode->component_stock_code }} - {{ $stockCode->component_description }}</h1>
<table>
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
			<tr >		
	        	<td>{{ $component->component_material_qty }}</td>
	        	<td>{{ $component->component_unit_of_measure }}</td>
	        	<td>{{ $component->option_name }}</td>
	        	<td>{{ $component->option_description }}</td>
	        	<td>{{ $component->base_van }}</td>
        	</tr>			
		@endforeach
	</tbody>
</table>