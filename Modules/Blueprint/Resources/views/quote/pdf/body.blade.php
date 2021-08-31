<table class="quote-body">
	<thead>
		<tr style="color:white; background-color: rgb(45, 47, 114);">
			<th style="text-align:left;color:white;">Name</th>
			<th style="text-align:left;color:white;">Description</th>
			<th style="text-align:left;color:white;">Qty</th>
		<tr>
		</thead>
		<tbody>
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