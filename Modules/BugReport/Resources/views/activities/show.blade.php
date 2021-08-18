<table class="table table-striped">
    <thead>
        <tr>
            <th>Sequence</th>
            <th>Title</th>
            <th>Assigned To</th>
            <th>Due By</th>
            <th>Notes</th>
            <th>Complete</th>
        </tr>
    </thead>
    <tbody>
        @forelse( $activities as $activity )
            <tr>
                <td>{{ $activity->sequence }}</td>
                <td>{{ $activity->title }}</td>
                <td>{{ $activity->assignedUser->first_name }}</td>
                <td>{{ $activity->due_date }}</td>
                <td>{{ $activity->notes }}</td>
                <td>{{ ($activity->completed) ? "Done" : "Not Done" }}</td>
            </tr>
        @empty
            <tr>
                <td colspan="6">No tasks yet</td>
            </tr>
        @endforelse
    </tbody>
</table>
