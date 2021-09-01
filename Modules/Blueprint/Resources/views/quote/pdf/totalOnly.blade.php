<table id="quoteBody">
	<thead>
		<tr>
			<th style="text-align:left;color:white;">Name</th>
			<th style="text-align:left;color:white;">Description</th>
			<th style="text-align:left;color:white;">Qty&nbsp;</th>
		<tr>
	</thead>
	<tbody>
		<tr><td colspan="4"></td></tr>
		@foreach ($configuration as $config)
			<tr>
				<td>{{ $config->name }}</td>
				<td>{{ $config->description }}</td>
				<td>{{ $config->quantity }}</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="1"></td>
			<td style="font-size: 15pt; color:white; text-align: right; ">Total: {{ $blueprint->currency }}</td>
			<td style="font-size: 15pt; color:white; ">${{ number_format( $total, 0 ) }}*</td>
		</tr>
	</tfoot>
</table>