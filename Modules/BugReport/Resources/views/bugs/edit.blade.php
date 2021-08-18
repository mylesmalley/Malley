<div class="card border-primary document-content-wrapper">
<form action="{{ url( 'bugs/'.$bug->id ) }}"
      method="POST">
    {{ method_field('PATCH') }}
    {{ csrf_field() }}

    <table class="table table-striped table-hover">
        <tbody>
        <tr>
            <td><label for="title">Title</label></td>
            <td>

                <input type="text" class="form-control" id="title" name="title" value="{{ $bug->title ?? old('title') ?? '' }}">
            </td>
        </tr>
        <tr>
            <td>
                <label for="category">Priority</label>

            </td>
            <td>
                <select class="form-control"
                        id='category'
                        name="urgency">


                    @if ( $bug->engineering_task )

                        @foreach ( \App\Models\BugReport::$engineeringUrgencies as $key => $value )
                            <option
                                @if(  $bug->urgency == $key )
                                selected
                                @endif
                                value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    @else
                        @foreach ( \App\Models\BugReport::$blueprintUrgencies as $key => $value )
                            <option
                                @if(  $bug->urgency == $key )
                                selected
                                @endif
                                value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    @endif

                </select>




            </td>
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
            <td>
                				<textarea
                                    name="user_notes"
                                    id="user_notes"
                                    cols="30"
                                    rows="10"
                                    class="form-control"
                                >{{ $bug->user_notes }}</textarea>
                </td>
        </tr>
        <tr>
            <td>Due By</td>
            <td>
                {{ $bug->due_date }} </td>
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
        @endif
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

{{--        <tr>--}}
{{--            <td>--}}

{{--                <label for="assigned_user_id">Assigned To</label>--}}
{{--            </td>--}}
{{--            <td>--}}

{{--                <select class="form-control"--}}
{{--                        id='assigned_user_id'--}}
{{--                        name="assigned_user_id">--}}
{{--                    <option value="">Unnasigned</option>--}}
{{--                    @foreach ( $users as  $user )--}}
{{--                        <option--}}
{{--                            @if( old('assigned_user_id') == $user->id--}}
{{--                                || $bug->assigned_user_id == $user->id--}}
{{--                                )--}}
{{--                            selected--}}
{{--                            @endif--}}
{{--                            value="{{ $user->id }}">{{ $user->first_name . ' ' . $user->last_name }}</option>--}}
{{--                    @endforeach--}}
{{--                </select>--}}

{{--            </td>--}}
{{--        </tr>--}}



        </tbody>
    </table>
    <input type="submit" value="Save Change" class="btn btn-primary">

</form>
</div>
