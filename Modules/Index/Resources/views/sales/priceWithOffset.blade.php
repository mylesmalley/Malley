@extends('index::app.main')
@section("content")
	<h1>{{ $basevan->name }}</h1>

	@includeIf('index::app.components.tabs', ['platform' => $basevan, 'selected' => 'priceedit'] )

	<h3> INTERNAL PRICE LIST WITH OFFSETS </h3>
	<table class="table table-striped table-hover">
		<thead class="thead-dark">
			<tr>
				<th>Option</th>
				<th>Description</th>
				<th>Cost</th>
				<th>Dealer Price Offset</th>
				<th>Dealer Price</th>
				<th>MSRP Price Offset</th>
				<th>MSRP</th>
			</tr>
		</thead>
		<tbody>
		@foreach( $options as $option )
			<tr onclick="go({{ $basevan->id }}, {{ $option->id }})">
				<td>{{ $option->option_name }}</td>
				<td>{{ $option->option_description }}</td>
				<td>{{ $option->totalCost() }}</td>
				<td>{{ ($option->option_price_dealer_offset > 0) ? number_format($option->option_price_dealer_offset, 0): '' }}</td>
				<td>
					@if ( ($option->option_price_dealer_offset > 0) )
						<strike>
							{{ ($option->option_price_tier_2) ? number_format( $option->option_price_tier_2, 0) : '' }}
						</strike>
						{{ ($option->DealerPrice()) ? number_format( $option->DealerPrice() , 0) : 0 }}
					@else
						{{ ($option->DealerPrice()) ? number_format( $option->DealerPrice() , 0) : '' }}
					@endif
				</td>
				<td>{{ ($option->option_price_msrp_offset > 0) ? number_format($option->option_price_msrp_offset, 0): '' }}</td>
				<td>
					@if ( ($option->option_price_msrp_offset > 0) )
						<strike>
							{{ ($option->option_price_tier_3) ? number_format( $option->option_price_tier_3, 0) : '' }}
						</strike>
						{{ ($option->MSRPPrice()) ? number_format( $option->MSRPPrice() , 0) : 0 }}
					@else
						{{ ($option->MSRPPrice()) ? number_format( $option->MSRPPrice() , 0) : '' }}
					@endif
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

@endsection

@section('scripts')
	<script>
		function go( basevanid, id )
		{
			window.location.href = `/sales/${basevanid}/option/${id}/pricing`;
		}
	</script>
@endsection
