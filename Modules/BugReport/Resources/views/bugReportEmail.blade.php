<h1>A New Bug Report</h1>

<p>{{ $bug->first_name }} {{ $bug->last_name }} {{ $bug->organization ? 'from '.$bug->organization : "" }} has submitted a new bug report.</p>
{{--<p>Click <a href="{{ url('warranty/'.$claim->pin ) }}">here</a> to open it in a browser.</p>--}}


<table class="table table-striped table-hover">
	<tbody>
	<tr>
		<td>Issue</td>
		<td>{{ $bug->title }}<br />Priority: {{ $bug->urgency }}</td>
	</tr>
	<tr>
		<td>Submitted By</td>
		<td>{{ $bug->user->first_name . ' ' . $bug->user->last_name . " - ({$bug->user->id})" }} </td>
	</tr>
{{--	<tr>--}}
{{--		<td>Created</td>--}}
{{--		<td>{{ $bug->created_at->format('Y-m-d') }} </td>--}}
{{--	</tr>--}}
{{--	<tr>--}}
{{--		<td>Last Updated</td>--}}
{{--		<td>{{ $bug->updated_at->format('Y-m-d') }} </td>--}}
{{--	</tr>--}}
	<tr>
		<td>Description</td>
		<td>{{ $bug->user_notes }}</td>
	</tr>
	
	<tr>
		<td>Reference</td>
		<td>{{ $bug->related_table . ' - #' . $bug->related_id }}</td>
	</tr>
	
	<tr>
		<td>URL</td>
		<td>{{ $bug->url }}</td>
	</tr>
	<tr>
		<td>Browser </td>
		<td>{{ $bug->browser . ' ' . $bug->full_version }}</td>
	</tr>
	<tr>
		<td>User Agent </td>
		<td>{{ $bug->user_agent }}</td>
	</tr>
	<tr>
		<td>
			Files
		</td>
		<td>
			@foreach( $bug->media as $item )
				
				<a href="https://blueprint.malleyindustries.com/media/{{ $item->id }}">{{ $item->file_name }}</a><br />
			
			@endforeach
		</td>
	</tr>
	
	</tbody>
</table>