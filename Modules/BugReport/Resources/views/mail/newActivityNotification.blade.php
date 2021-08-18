<p>Hi {{ $user->first_name }}. You have been assigned work to be done on an engineering project.</p>

<h3>{{ $bug->title }}</h3>
<p>{{ $bug->urgencyLabel }}</p>
<p>{{ $bug->user_notes }}</p>

<a href="https://index.malleyindustries.com/bugs/{{ $bug->id }}">Click here to this project.</a>
<a href="https://index.malleyindustries.com/bugs/user/{{ $user->id }}">Click here to see all of your assigned Tasks.</a>

<h3>Your task(s)</h3>
<table class="table table-striped table-hover">
    <thead>
        <tr>
            <th>Sequence</th>
            <th>Task</th>
            <th>Due</th>
            <th>Completed</th>
        </tr>
    </thead>
    <tbody>

    @foreach( $activities as $activity)
        <tr>
            <td>{{ $activity->sequence }}</td>
            <td>{{ $activity->title }}</td>
            <td>{{ $activity->date_due }}</td>
            <td>{{ $activity->completed ? "Yes" : "No" }}</td>
        </tr>
        @endforeach
    </tbody>

</table>
