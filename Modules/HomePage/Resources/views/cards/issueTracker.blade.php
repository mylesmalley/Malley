<div class="col-md-3">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white ">
			Issue Tracker
		</div>
		<ul class="list-group list-group-flush">
            @if (Auth::user() )
            <li class="list-group-item">
                <a href="{{ url('bugs/user/'.Auth::user()->id ) }}">My Assigned Tasks</a>
            </li>
            @endif
			<li class="list-group-item">
                <a href="{{ url('https://index.malleyindustries.com/bugs/engineering') }}">New Engineering Project</a>
			</li>
            <li class="list-group-item">
                <a href="{{ url('https://blueprint.malleyindustries.com/bugs/create') }}">New Blueprint Issue</a>
            </li>

            <li class="list-group-item">
                <a href="{{ url('bugs/all/engineering') }}">Open Engineering Projects</a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('bugs/all/blueprint') }}">Open Blueprint Issues</a>
            </li>

		</ul>
	</div>
</div>
