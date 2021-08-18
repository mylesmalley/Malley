@extends('index::app.main')

@section("content")

	<h1>VIN Assignment Report</h1>

	@includeIf('app.components.errors')

	<table class="table table-hover table-condensed table-striped">
		<thead>
			<tr>
				<th>Job</th>
				<th>Description</th>
				<th>Customer</th>
				<th>Status</th>
				<th>Tender Date</th>
				<th>Type</th>
				<th>Chassis</th>
			</tr>
		</thead>
		<tbody>
			@foreach( $results as $row )
				<tr>
					<td>{{ $row->Job }}</td>
					<td>{{ $row->JobDescription }}</td>
					<td>{{ $row->CustomerName }}</td>
					<td>
						@if ( $row->Complete === "Y")
							Closed
						@else
							{{ $row->status === 'Y' ? "Started" : "Planned" }}
						@endif
					</td>
					<td>{{ substr( $row->JobTenderDate, 0, 10) }}</td>
					<td>{{ $row->JobClassification }}</td>
					<td>{{ $row->VIN }}<br />{{ $row->VehicleType }}</td>
				</tr>
			@endforeach
		</tbody>
	</table>

@endsection
