<h1>Proejct Update</h1>
<p>Hi {{ $user->first_name }},.</p>
<p>{{ $previousActivity->assignedUser->first_name }} has finished their task, <b>{{ $previousActivity->title }}</b>,
    on the project <b>{{ $bug->title }}</b>.</p>

<h3>Next Task</h3>
<p>Your next assigned task is to <b>{{ $nextActivity->title }}</b></p>

<h3>Priority</h3>
<p>Based on due date and urgency, this project has a {{ round( $bug->priority ) }}% level.</p>

<h3>Notes on the Project</h3>
<p>{{ $bug->user_notes }}</p>

<a href="https://index.malleyindustries.com/bugs/{{ $bug->id }}">Click here to this project.</a>
<a href="https://index.malleyindustries.com/bugs/user/{{ $user->id }}">Click here to see all of your assigned Tasks.</a>
