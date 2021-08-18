<div class="card border-primary ">
    <div class="card-header bg-primary text-white">Revision History</div>
    <table class="table table-sm table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Rev #</th>
                <th>Obsolete</th>
                <th>Date created</th>
                <th>Created By</th>
                <th>Note</th>
            </tr>
        </thead>
        <tbody>
            @foreach( $option->revisions() as $rev )
            <tr>
                <td><a href="{{ url("/index/option/{$rev->id}/home") }}">{{ $rev->id }}</a></td>
                <td><a href="{{ url("/index/option/{$rev->id}/home") }}">{{ $rev->revision }}</a></td>
                <td>{!! $rev->obsolete
                            ? "<span class='text-danger'>YES</span>"
                            : "<span class='text-success'>NO</span>" !!}</td>
                <td>{{ $rev->created_at }}</td>
                <td>{{ $rev->user ? $rev->user->first_name : "N/A" }}</td>
                <td>{{ $rev->engineering_notes }}</td>
            </tr>
                @endforeach
        </tbody>
    </table>
</div>
