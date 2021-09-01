<h1>Here is Your Quote</h1>
<p>Attacched is the quote you requested for <b>B-{{ $blueprint->id }}</b>, "{{$blueprint->description}}".</p>
<ul>
    <li>
        To see this blueprint, <a href="{{ route('blueprint.home', [$blueprint]) }}">Click Here</a>
    </li>
    <li>
        To make changes to the quote, <a href="{{ route('blueprint.quote', [$blueprint]) }}">Click Here</a>
    </li>
</ul>