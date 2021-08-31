@php
	$total = 0;
@endphp
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
			@if ( $config->value  &&  $config->show_on_quote )
				@php
					$linePrice = $config->DealerPrice( $blueprint->exchange_rate ) * $config->quantity;
					$total += $linePrice;
				@endphp
				<tr>
					<td>{{ $config->name }}</td>
					<td>{{ $config->description }}</td>
					<td>{{ $config->quantity }}</td>
					<td style="text-align:right;">
						{{ ($linePrice != 0) ? number_format($linePrice,0) : '' }}
					</td>
				</tr>
			@endif
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