@extends('index::app.main')

@section("content")



	<h1>Recent Deliveries</h1>
	@includeIf('syspro::inventory.invDepartmentTabs', [ 'path'=>'recentdeliveries', 'selected' => $dept] )

	<table class='table table-striped table-sm table-hover'>
		<thead>
			<tr>
				<th>Stock Code</th>
				<th>Description</th>
				<th>Ordered</th>
				<th>Received</th>
				<th>PO</th>
				<th>Order Placed</th>
				<th>EST ArrivalDate</th>
				<th>Lead Time</th>
				<th>Arrived On</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lines as $line)
				<tr>
					<td>{{ $line->StockCode }}</td>
					<td>{{ $line->Description }}</td>
					<td>{{ number_format( $line->Ordered, 1) }}</td>
					<td>{{ number_format( $line->Received, 1) }}</td>
					<td>{{ $line->PurchaseOrder }}</td>
					<td>{{ $line->OrderPlaced }}</td>
					<td>{{ $line->ESTArrivalDate }}</td>
					<td>{{ $line->LeadTime }}</td>
					<td>{{ $line->ArrivedOn }}</td>
				</tr>
			@endforeach
		</tbody>

	</table>

@endsection
