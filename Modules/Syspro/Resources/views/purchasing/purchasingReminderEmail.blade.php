<h1>Parts need to be ordered</h1>
<ul>
    @forelse( $purch as $req )
        <li><a href="{{ "https://index.malleyindustries.com/syspro/purchasing/" . $req->id . "/editRequest" }}">{{ $req->user->first_name }} - {{ $req->description }}</a></li>
    @empty
        <li>All good. You shouldn't have received this.</li>
    @endforelse
</ul>

<ul>
    <li><a href="http://index.malleyindustries.com/syspro/purchasing/openRequests">Go to the list.</a></li>
</ul>
