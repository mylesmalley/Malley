<h3>On Hold - {{ $bug->title }}</h3>
<p>This project has been marked as on hold.</p>
<p>{{ $bug->urgencyLabel }}</p>
<p>{{ $bug->user_notes }}</p>

<a href="https://index.malleyindustries.com/bugs/{{ $bug->id }}">Click here to this project.</a>

