<table id="quoteBody">
	<thead>
		<tr>
			<th style="text-align:left;color:white;">Name</th>
			<th style="text-align:left;color:white;">Description</th>
			<th style="text-align:left;color:white;">Qty&nbsp;</th>
			<th style="text-align:right;color:white;">Price</th>
		<tr>
	</thead>
	<tbody>
		<tr><td colspan="4"></td></tr>
		@foreach ($configuration as $config)
			<tr>
				<td>{{ $config->name }}</td>
				<td>{{ $config->description }}</td>
				<td>{{ $config->quantity }}</td>
				<td style="text-align:right;">
					{{ number_format( $config->quantity * $config->price_tier_2 * $blueprint->exchange_rate, 2 ) }}
				</td>
			</tr>
		@endforeach
	</tbody>
	<tfoot>
		<tr>
			<td colspan="2"></td>
			<td style="font-size: 15pt; color:white; ">{{ $blueprint->currency }}</td>
			<td style="font-size: 15pt; color:white; ">${{ number_format( $total, 0 ) }}*</td>
		</tr>
	</tfoot>
</table>