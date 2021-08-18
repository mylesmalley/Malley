@extends('index::app.main')

@section("content")

	<h1>Open Part Build Orders</h1>
	@includeIf('syspro::inventory.invDepartmentTabs', [ 'path'=>'openPartsBuildOrders', 'selected' => $dept] )

	<table class='table table-striped table-sm table-hover'>
		<thead>
			<tr>
				<th>PB Job</th>
				<th>Stock Code</th>
				<th>Description</th>
				<th>Quantity</th>
				<th>Qty Made</th>
				<th>DateOpened</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lines as $line)
				<tr>
					<td>{{ $line->PBJob }}</td>
					<td>{{ $line->StockCode }}</td>
					<td>{{ $line->Description }}</td>
					<td>{{ $line->JobQty }}</td>
					<td>{{ $line->QtyMade }}</td>
					<td>{{ $line->DateOpened }}</td>
					<td>{{ $line->Status }}</td>
				</tr>
			@endforeach
		</tbody>

	</table>

@endsection
