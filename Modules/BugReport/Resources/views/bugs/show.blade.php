<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <td>Issue</td>
        <td>{{ $bug->title }}<br />Priority: {{ $bug->urgencyLabel }}</td>
    </tr>
    <tr>
        <td>Due By</td>
        <td>
            {{ $bug->due_date }} </td>
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
        </tr>
    @endif

    <tr>
        <td>
            <label for="dev_notes">Notes</label>
        </td>
        <td>


        {{ $bug->dev_notes }}
    </tr>
    @if( $bug->engineering_task )
        <tr>
            <td>File Locations</td>
            <td>{{ $bug->file_locations }}</td>
        </tr>
    @endif
    </tbody>
</table>
