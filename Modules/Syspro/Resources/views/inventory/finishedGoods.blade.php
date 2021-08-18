@extends('index::app.main')

@section("content")

	<h1>Finished Plastic Parts</h1>

	<table class='table table-striped table-sm table-hover'>
		<thead>
			<tr>
				<th>Stock Code</th>
				<th>Description</th>
				<th>Unit Cost</th>
				<th>On Hand</th>
				<th>On Order</th>
				<th>Allocated WIP</th>
				<th>Future Free</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lines as $line)
				<tr>
					<td>{{ $line->StockCode }}</td>
					<td>{{ $line->Description }}</td>
					<td>$ {{ number_format( $line->UnitCost,2) }}</td>
					<td>{{ number_format( $line->OnHand ) }}</td>
					<td>{{ number_format( $line->OnOrder ) }}</td>
					<td>{{ number_format( $line->AllocatedWIP ) }}</td>
					<td>{{ number_format( $line->FutureFree ) }}</td>
				</tr>
			@endforeach
		</tbody>

	</table>

@endsection
