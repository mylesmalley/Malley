@extends('index::app.main')
@section("content")
	<h1>{{ $basevan->name }}</h1>

	@includeIf('index::app.components.tabs', ['platform' => $basevan, 'selected' => 'pricelist'] )
	<h3>Price List </h3>
{{--	{{ count( $options) }}--}}
	<table class="table table-striped">
		<thead class="thead-dark">
			<tr>
				<th>Option</th>
				<th>Description</th>
				<th>Dealer Price</th>
				<th>MSRP</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $options as $option )
				<tr>
					<td>{{ $option->option_name }}</td>
					<td>{{ $option->option_description }}</td>
					<td>{{ ($option->DealerPrice()) ? number_format( $option->DealerPrice(), 0) : '' }}</td>
					<td>{{ ($option->MSRPPrice()) ? number_format( $option->MSRPPrice(), 0) : '' }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection
