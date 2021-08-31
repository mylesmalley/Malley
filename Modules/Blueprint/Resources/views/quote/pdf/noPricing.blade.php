<table id="quoteBody">
	<thead>
		<tr>
			<th style="text-align:left;color:white;">Name</th>
			<th style="text-align:left;color:white;">Description</th>
			<th style="text-align:left;color:white;">Qty</th>
		<tr>
	</thead>
	<tbody>
	<tr><td colspan="3"></td></tr>
	
	@foreach ($configuration as $config)
			@if ( $config->value  &&  $config->show_on_quote )
				<tr>
					<td>{{ $config->name }}</td>
					<td>{{ $config->description }}</td>
					<td>{{ $config->quantity }}</td>
				</tr>
			@endif
		@endforeach
	</tbody>
</table>