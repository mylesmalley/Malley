<h1>{{ $user->first_name }}'s Tasks for {{ date('F d') }}</h1>

<p>You have tasks assigned on <strong>{{ $openBugs->count() ?? 0 }} projects</strong> which you can see
    <a href="https://index.malleyindustries.com/bugs/user/{{ $user->id }}">here</a></p>

<h2>Needing to be addressed</h2>
<p>Your assigned tasks are the next things due in the following projects:</p>
@foreach( $openBugs as $bug )
    @if( $bug->activities->where('completed',false)->first()->assigned_user_id == $user->id )
        <h3><a href="https://index.malleyindustries.com/bugs/{{ $bug->id  }}">{{ $bug->title ?? "Title" }}</a> Project Priority: {{ round($bug->priority ) }}%</h3>
        <ul>
            <li>{{  $bug->activities->where('completed',false)->first()->title  }}</li>
        </ul>
    @endif
@endforeach
