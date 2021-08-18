@extends('bugreport::template')
@section('content')
    @if( $bug->engineering_task )
        <h1>{{ $bug->title }} - {{ $bug->status }}</h1>

    @else
        <h1>Bug #{{ $bug->id }} - {{ $bug->status }}</h1>

    @endif

	@includeIf('bugreport::errors')


    <form action="{{ url( 'bugs/'.$bug->id ) }}"
          method="POST">
        {{ csrf_field() }}

	<table class="table table-striped table-hover">
		<tbody>
			<tr>
				<td>Issue</td>
				<td>{{ $bug->title }}<br />Priority: {{ $bug->urgencyLabel }}</td>
			</tr>
			<tr>
				<td>Submitted By</td>
				<td>{{ $bug->user->first_name . ' ' . $bug->user->last_name  }} </td>
			</tr>
			<tr>
				<td>Created</td>
				<td>{{ $bug->created_at->format('Y-m-d') }} </td>
			</tr>
			<tr>
				<td>Last Updated</td>
				<td>{{ $bug->updated_at->format('Y-m-d') }} </td>
			</tr>
			<tr>
				<td>Description</td>
				<td>{{ $bug->user_notes }}</td>
			</tr>
@if(! $bug->engineering_task )
			<tr>
				<td>Reference</td>
				<td>{{ $bug->related_table . ' - #' . $bug->related_id }}</td>
			</tr>

			<tr>
				<td>URL</td>
				<td><a href="{{ $bug->url }}">{{ substr( $bug->url, 0, 50 ) }}</a></td>
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
                        <a href="{{ $item->cdnUrl() }}">{{ $item->file_name }}</a>
{{--						<a href="https://blueprint.malleyindustries.com/media/{{ $item->id  }}">{{ $item->file_name }}</a><br />--}}
					@endforeach
				</td>
			</tr>

			<tr>
				<td>
					<label for="dev_notes">Notes</label>
				</td>
                <td>

						<textarea
							name="dev_notes"
							id="dev_notes"
							cols="30"
							rows="10"
							class="form-control"
						>{{ $bug->dev_notes }}</textarea>
                </tr>
            @if( $bug->engineering_task )
                <tr>
                    <td>File Locations</td>
                    <td>{{ $bug->file_locations }}</td>
                </tr>
            @endif

                <tr>
                <td>

						<label for="status">Status</label>
                </td>
                    <td>
						<select class="form-control"
						        id='status'
						        name="status">
							@foreach ( [
								 "Open",
								 'On hold',
								 "Closed",
							] as  $value )
								<option
										@if( old('status') === $value
											|| $bug->status === $value
											)
										selected
										@endif
										value="{{ $value }}">{{ $value }}</option>
							@endforeach
						</select>

                  </td>
                </tr>

            <tr>
                <td>

                    <label for="assigned_user_id">Assigned To</label>
                </td>
                <td>

                    <select class="form-control"
                            id='assigned_user_id'
                            name="assigned_user_id">
                            <option value="">Unnasigned</option>
                        @foreach ( $users as  $user )
                            <option
                                @if( old('assigned_user_id') == $user->id
                                    || $bug->assigned_user_id == $user->id
                                    )
                                selected
                                @endif
                                value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>
                        @endforeach
                    </select>

                </td>
            </tr>


            <tr>


                <td colspan="2">
						<input type="submit" value="Save Change" class="btn btn-primary">
				</td>
			</tr>


		</tbody>
	</table>

    </form>


    @if( Auth::user()->bug_report_editor )
        @includeIf('bugreport::activities.edit', ['activities' => $bug->activities])
    @else
        @includeIf('bugreport::activities.show', ['activities' => $bug->activities])
    @endif
@endsection
