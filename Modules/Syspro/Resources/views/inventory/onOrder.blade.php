@extends('index::app.main')

@section("content")



	<h1>On Order</h1>
	@includeIf('syspro::inventory.invDepartmentTabs', [ 'selected' => $dept] )

	<table id="invtable" class='table table-striped table-sm table-hover'>
		<thead>
			<tr>
				<th>Stock<br />Code</th>
				<th>Description
					<a href="/inventory/onorder/{{$dept}}/Description/DESC">&darr;</a>
					<a href="/inventory/onorder/{{$dept}}/Description/ASC">&uarr;</a>
				</th>
				<th>Ordered</th>
				<th>Received</th>
				<th>Purchase<br />Order
					<a href="/inventory/onorder/{{$dept}}/PO/DESC">&darr;</a>
					<a href="/inventory/onorder/{{$dept}}/PO/ASC">&uarr;</a>
				</th>
				<th>Order<br />Placed</th>
				<th>Expected<br />Arrival<br />Date
					<a href="/inventory/onorder/{{$dept}}/ESTArrivalDate/DESC">&darr;</a>
					<a href="/inventory/onorder/{{$dept}}/ESTArrivalDate/ASC">&uarr;</a>
				</th>
				<th>Lead<br />Time</th>
				<th>Days<br />Passed
					<a href="/inventory/onorder/{{$dept}}/DaysPassed/DESC">&darr;</a>
					<a href="/inventory/onorder/{{$dept}}/DaysPassed/ASC">&uarr;</a>
				</th>
				<th>Status
					<a href="/inventory/onorder/{{$dept}}/DaysLeft/DESC">&darr;</a>
					<a href="/inventory/onorder/{{$dept}}/DaysLeft/ASC">&uarr;</a>
				</th>
			</tr>
		</thead>
		<tbody>
			@foreach($lines as $line)
				<tr
					@if  ( (int)$line->DaysLeft < 0)
						class="table-danger"
					@endif
				>
					<td>{{ $line->StockCode }} </td>
					<td>{{ $line->Description }}</td>
					<td>{{ number_format( $line->Ordered, 1) }}</td>
					<td>{{ number_format( $line->Received, 1) }}</td>
					<td>{{ $line->PO }}</td>
					<td>{{ $line->OrderPlaced }}</td>
					<td>{{ $line->ESTArrivalDate }}</td>
					<td>{{ $line->LeadTime }}</td>
					<td>{{ $line->DaysPassed }}</td>
					<td>{{ ( (int)$line->DaysLeft > 0) ? "Due in {$line->DaysLeft} days" : "Late by ".abs($line->DaysLeft)." days" }}</td>
				</tr>
			@endforeach
		</tbody>

	</table>

@endsection


@section('stylesheet')
	<style>
		#invtable tbody tr td {
			font-size: 9pt;
		}
	</style>
	@endsection
