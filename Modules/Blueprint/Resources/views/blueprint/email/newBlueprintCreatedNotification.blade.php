<h1>New Blueprint Created</h1>
<p>{{ $blueprint->user->first_name }} {{ $blueprint->user->last_name }} from {{ $blueprint->user->company->name }} has created a new Blueprint</p>
<table>
    <thead>

    </thead>
    <tbody>
    <tr>
        <td>Name</td>
        <td>{{ $blueprint->name }}</td>
    </tr>
    <tr>
        <td>Platform</td>
        <td>{{ $blueprint->platform->name }}</td>
    </tr>
    <tr>
        <td>Description</td>
        <td>{{ $blueprint->description }}</td>
    </tr>
    </tbody>
</table>

<ul>
    <li><a href="{{ route('blueprint.home', [$blueprint]) }}">Go to this Blueprint</a></li>
    <li><a href="{{ route('my_blueprints', [ $blueprint->user->id ]) }}">See all of {{ $blueprint->user->first_name }}'s Blueprints'</a></li>
</ul>