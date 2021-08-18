<li>
	
	
	<svg id="i-camera" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
		<path d="M2 8 L 9 8 12 4 20 4 23 8 30 8 30 26 2 26 Z" />
		<circle cx="16" cy="16" r="5" />
	</svg>

	
	{{ $album->name }}


	<div class="btn-group">
		<button class="btn btn-outline-primary btn-sm dropdown-toggle"
		        type="button"
		        data-toggle="dropdown"
		        aria-haspopup="true"
		        aria-expanded="false"></button>
		<div class="dropdown-menu">
			
			<a class='dropdown-item' href='/albums/{{ $album->id }}'>Open</a>
			<a class='dropdown-item' href='/albums/{{ $album->id }}/create'>Add Album</a>
				<a class='dropdown-item' href='/albums/{{ $album->id }}/edit'>Change Name</a>


			@if ($album->isLeaf() && count($album->media) === 0)

				<form action="{{ '/albums/'.$album->id }}" method="POST">
					{{ csrf_field() }}
					{{ method_field("DELETE") }}
					<input type="submit" class="dropdown-item" value="Delete">
				</form>
			@endif

		</div>
	</div>


</li>
	@if ( count($album->children) )
	    <ul style="list-style-type: none;">
	    @foreach($album->children as $child)
	        @include('albums.partials.list', ['album'=>$child ])
	    @endforeach
	    </ul>
	@endif