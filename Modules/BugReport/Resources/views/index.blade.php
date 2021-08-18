@extends('bugreport::template')

@section('content')

	<h1>Latest Issues</h1>
	<table class='table table-striped table-condensed table-hover'>
		<thead>
			<tr>
				<th>#</th>
				<th>Submitted By</th>
				<th>Title</th>
				<th>Description</th>
				<th>Urgency</th>
                <th>Status</th>
                <th>Assigned To</th>
			</tr>
		</thead>
		<tbody>
		@foreach($bugs as $bug)
			<tr
					@if ($bug->status === "Closed" )
							class="table-success"
					@endif
					@if ($bug->status === "On hold" )
					class="table-warning"
					@endif
					@if ($bug->status === "Open" )
					class="table-danger"
					@endif
					onclick="window.location = '/bugs/{{ $bug->id }}'">
				<td>{{ $bug->id }}</td>
				<td>{{ $bug->userName }}</td>
				<td>{{ $bug->title }}</td>
				<td>{{ substr($bug->user_notes, 0, 100 ) }}
				@if( strlen( $bug->user_notes) > 99 )
					...
				@endif
					@if( $bug->dev_notes)
					<hr >
						{{ $bug->dev_notes }}
					@endif
				</td>
				<td
						@if ( $bug->status !== "Closed")
						style="background-color: {{ $bug->colour }};"
						@endif
					>{{ $bug->urgencyLabel  }}</td>
                <td>{{ $bug->status }}</td>
                <td>{{ $bug->assignedUser->first_name ?? 'Not Assigned' }}</td>
			</tr>
		@endforeach
		</tbody>

	</table>


    {{ $bugs->links() }}
@endsection
