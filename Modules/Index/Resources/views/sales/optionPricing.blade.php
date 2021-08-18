@extends('index::app.main')

@section('content')
	<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
		<div class="btn-group mr-2" role="group" aria-label="Second group">
			@if ($option->previousID)
				<a href="/sales/{{ $option->base_van_id }}/option/{{ $option->previousId }}/pricing" class="btn btn-secondary">Previous (J)</a>
			@endif
			@if ($option->nextID)
				<a href="/sales/{{ $option->base_van_id }}/option/{{ $option->nextID }}/pricing" class="btn btn-secondary">Next (K)</a>
			@endif
		</div>

	</div>
	<div class="panel-heading"><h1>
			{{ $option->option_name }}
		</h1>
		<h2>
			{{ $option->option_description }}
		</h2>


	</div>
	@includeIf('index::app.components.tabs', ['platform' => $option->platform, 'selected' => 'priceedit'] )

	@includeIf('app.components.errors')

	<div class="panel-body">
		<form action="{{ url('sales/'.$basevan->id.'/option/'.$option->id.'/pricing') }}" method="POST">
			{{ csrf_field() }}
			{{ method_field('PATCH') }}

		<h2>Pricing</h2>
		<div class='row'>
			<div class='col-md-2'>
				<div class="form-group">
					<label for="cost">Cost</label>
					<input type="text"
					       readonly
					       class="form-control"
					       name="cost"
					       id="cost"
					       value="{{ $option->totalCost() }}" />
				</div>
			</div>
			<input type="hidden" name="option_price_tier_1" id="option_price_tier_1" value="0">
			<div class='col-md-2'>
				<div class="form-group">
					<label for="option_price_dealer_offset">Base Price Offset</label>
					<input type="text"
					       class="form-control price-form"
					       name="option_price_dealer_offset"
					       id="option_price_dealer_offset"
					       value="{{ $option->option_price_dealer_offset }}" />
				</div>
			</div>
			<div class='col-md-2'>
				<div class="form-group">
					<label for="option_price_tier_2 ">Dealer Price</label>
					<input type="text"
					       class="form-control  price-form"
					       name="option_price_tier_2"
					       id="option_price_tier_2"
					       value="{{ $option->option_price_tier_2 }}" />
				</div>
			</div>
			<div class='col-md-2'>
				<div class="form-group">
					<label for="option_price_msrp_offset">MSRP Price Offset</label>
					<input type="text"
					       class="form-control price-form"
					       name="option_price_msrp_offset"
					       id="option_price_msrp_offset"
					       value="{{ $option->option_price_msrp_offset }}" />
				</div>
			</div>
			<div class='col-md-2'>
				<div class="form-group">
					<label for="option_price_tier_3">MSRP Price</label>
					<input type="text"
					       class="form-control  price-form"
					       name="option_price_tier_3"
					       id="option_price_tier_3"
					       value="{{ $option->option_price_tier_3 }}" />
				</div>
			</div>

		</div>
			<input type="submit" class="btn btn-primary">

		</form>

		<br />
	<hr />
	<br />
		<h3>Customer Sees</h3>
		<div class='row'>
			<div class='col-md-2'>
				<div class="form-group">
					<label for="cost">Dealer Price</label>
					<input type="text" readonly class="form-control" name="cost" id="customer_dealer" value="0" />
				</div>
			</div>
			<div class='col-md-2'>
				<div class="form-group">
					<label for="cost">MSRP</label>
					<input type="text" readonly class="form-control " name="cost" id="customer_msrp" value="0" />
				</div>
			</div>
		</div>



		<table class="table table-small table-condensed table-striped">
			<thead class="thead-dark">
				<tr>
					<th>Part</th>
					<th>Description</th>
					<th>Qty</th>
					<th>Cost</th>
					<th>Cat.</th>
					<th>Cost</th>
					<th>Dealer</th>
					<th>MSRP</th>
				</tr>
			</thead>
			<tbody>
				@php
					$total_cost = 0;
					$total_dealer = 0;
					$total_msrp = 0;
				@endphp

				@foreach( $option->components as $com )
					@php
						$cat = trim( strtoupper( $com->component_price_category ) ) ?? "A";
						// dd( $markups[$cat] );

						$cost =  $com->component_material_cost * $com->component_material_qty ;
						$total_cost += $cost;

						$dealer = (array_key_exists( $cat, $markups)) ? $cost / (1 - $markups[ $cat ][0]) : $cost / (1 - .5);
						$total_dealer += $dealer;

						$msrp = (array_key_exists( $cat, $markups)) ? $cost / (1 - $markups[ $cat ][1]) : $cost / (1 - .7);
						$total_msrp += $msrp;

					@endphp
						<tr>
							<td> {{ $com->component_stock_code }} </td>
							<td> {{ $com->component_description }} </td>
							<td> {{ $com->component_material_qty }} {{ $com->component_unit_of_measure }} </td>
							<td>$ {{ number_format( $com->component_material_cost, 2) }} </td>
							<td> {{ $com->component_price_category }} </td>
							<td>$ {{ number_format( $cost, 2) }} </td>
							<td>$ {{ number_format( $dealer, 2) }} </td>
							<td>$ {{ number_format( $msrp, 2) }} </td>
						</tr>
					@endforeach

				@php

					$labour_cost =  $option->option_labour_qty * 25 ;
					$total_cost += $labour_cost;

					$labour_dealer = $option->option_labour_qty  * $markups[ 'L' ][0];;
					$total_dealer += $labour_dealer;

					$labour_msrp = $option->option_labour_qty * $markups[ 'L' ][1];
					$total_msrp += $labour_msrp;

				@endphp


				<tr>
					<td> LABOUR </td>
					<td>  </td>
					<td> {{ $option->option_labour_qty }} HRs </td>
					<td> </td>
					<td>  </td>
					<td>$ {{ number_format( $labour_cost, 2) }} </td>
					<td>$ {{ number_format( $labour_dealer, 2) }} </td>
					<td>$ {{ number_format( $labour_msrp, 2) }} </td>
				</tr>
			</tbody>
			<tfoot>
				<tr>
					<td colspan="5"></td>
					<td>$ {{ number_format( $total_cost, 2) }}</td>
					<td>$ <span id="total_dealer">{{ number_format( $total_dealer, 2) }}</span></td>
					<td>$ <span id="total_msrp">{{ number_format( $total_msrp, 2) }}</span></td>
				</tr>
			</tfoot>
		</table>




	</div>
@endsection

@section('scripts')
	<script>
		document.addEventListener('keypress', function(event){
			@if ($option->previousID)
				if (event.key === "j") {
					window.location.href = "/sales/{{ $option->base_van_id }}/option/{{ $option->previousId }}/pricing";
				}
			@endif
			@if ($option->nextID)
				if (event.key === "k") {
					window.location.href = "/sales/{{ $option->base_van_id }}/option/{{ $option->nextId }}/pricing";
				}
			@endif

		});



		function updateForm()
		{
			let option_price_dealer_offset = parseFloat( document.getElementById('option_price_dealer_offset').value );
			let option_price_msrp_offset = parseFloat( document.getElementById('option_price_msrp_offset').value );
			let option_price_tier_3 = parseFloat( document.getElementById('option_price_tier_3').value );
			let option_price_tier_2 = parseFloat( document.getElementById('option_price_tier_2').value );

		//	console.log(option_price_base_offset, option_price_tier_3,  option_price_tier_2 );
			document.getElementById('customer_dealer').value = option_price_tier_2 - option_price_dealer_offset;
			document.getElementById('customer_msrp').value = option_price_tier_3 - option_price_msrp_offset;
		}

		let formElements = document.getElementsByClassName('price-form');

		for ( let i = 0; i < formElements.length; i++)
		{
			formElements[i].addEventListener('change', () => updateForm() );
		}

		// Uncomment these two lines to automatically populate the dealer and msrp price with the suggested ones.

		// document.getElementById('option_price_tier_3').value =  parseFloat(document.getElementById('total_msrp').innerText.replace(/,/g, ''));
		// document.getElementById('option_price_tier_2').value =  parseFloat(document.getElementById('total_dealer').innerText.replace(/,/g, ''));
		//

		updateForm();
	</script>
@endsection
