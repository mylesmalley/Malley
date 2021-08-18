<h1>A New Engineering Task Was Submitted </h1>

<p>{{ $bug->first_name }} {{ $bug->last_name }} {{ $bug->organization ? 'from '.$bug->organization : "" }} has submitted a new engineering project..</p>
<p>
    <a href="https://index.malleyindustries.com/bugs/{{ $bug->id }}">Click here to review.</a>
</p>


<table class="table table-striped table-hover">
    <tbody>
    <tr>
        <td>Issue</td>
        <td>{{ $bug->title }}<br />Priority: {{ $bug->urgencyLabel }}</td>
    </tr>
    <tr>
        <td>Submitted By</td>
        <td>{{ $bug->user->first_name . ' ' . $bug->user->last_name . " - ({$bug->user->id})" }} </td>
    </tr>

    <tr>
        <td>Description</td>
        <td>{{ $bug->user_notes }}</td>
    </tr>



        @if ( $bug->media )
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
        @endif

    </tbody>
</table>

