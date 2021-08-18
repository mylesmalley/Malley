<li>{{ $q->question }}

	@if ($q->isLeaf() && $q->layout)
		<span class="badge badge-success"><a style="color:white;" href="/basevan/{{ $q->layout->base_van_id }}/layouts/{{$q->layout->id}}">{{ $q->layout->name }}</a></span>
	@endif

	<div class="btn-group">
		<button class="btn btn-outline-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		Actions
		</button>
		<div class="dropdown-menu">
			@if (! $q->isRoot() )
				<a class='dropdown-item' href='/questions/{{ $q->parent->id }}/create'>Add Sibling</a>
			@endif
			<a class='dropdown-item' href='/questions/{{ $q->id }}/create'>Add Child</a>
			<a class='dropdown-item' href='/questions/{{ $q->id }}/edit'>Edit</a>


			@if ($q->isLeaf())
					<form style="display:inline" action="{{ url('/questions/'.$q->id) }}">
						{{ csrf_field() }}
						{{ method_field('DELETE') }}
						<input type="submit" class="dropdown-item" value="Delete">
					</form>
			@endif

		</div>
	</div>


</li>
	@if ( count($q->children) )
	    <ul>
	    @foreach($q->children as $child)
	        @include('questions.partials.list', ['q'=>$child ])
	    @endforeach
	    </ul>
	@endif