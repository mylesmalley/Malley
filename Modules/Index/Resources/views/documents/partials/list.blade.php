<li>
	@php
		$isFile = ( $q->media_id ) ? true : false;
	@endphp
	
	
	@if ($isFile)
		<svg id="i-file" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
			<path d="M6 2 L6 30 26 30 26 10 18 2 Z M18 2 L18 10 26 10" />
		</svg>
	@else
		<svg id="i-folder" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 32 32" width="15" height="15" fill="none" stroke="currentcolor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
			<path d="M2 26 L30 26 30 7 14 7 10 4 2 4 Z M30 12 L2 12" />
		</svg>
	@endif
	
	{{ $q->name }}

{{--	@if ($q->isLeaf() && $q->layout)--}}
{{--		<span class="badge badge-success"><a style="color:white;" href="/basevan/{{ $q->media }}/layouts/{{$q->media->id}}">{{ $q->layout->name }}</a></span>--}}
{{--	@endif--}}

	<div class="btn-group">
		<button class="btn btn-outline-primary btn-sm dropdown-toggle"
		        type="button"
		        data-toggle="dropdown"
		        aria-haspopup="true"
		        aria-expanded="false"></button>
		<div class="dropdown-menu">

			@if (!$isFile)
				<a class='dropdown-item' href='/documents/{{ $q->id }}/create'>Add Folder</a>
				<a class='dropdown-item' href='https://blueprint.malleyindustries.com/documents/upload/{{ $q->id }}'>Add Document</a>
				@endif
				<a class='dropdown-item' href='/documents/{{ $q->id }}/edit'>Edit</a>


			@if ($q->isLeaf())
				@if ($isFile)
					<form action="{{ '/documents/'.$q->id.'/'.$q->media_id }}" method="POST">
						{{ csrf_field() }}
						{{ method_field("DELETE") }}
						<input type="submit" class="dropdown-item" value="Delete">
					</form>
					
				@else
					<form action="{{ '/documents/'.$q->id }}" method="POST">
						{{ csrf_field() }}
						{{ method_field("Delete") }}
						<input type="submit" class="dropdown-item" value="DELETE">
					</form>
					
				@endif
			@endif

		</div>
	</div>


</li>
	@if ( count($q->children) )
	    <ul style="list-style-type: none;">
	    @foreach($q->children as $child)
	        @include('documents.partials.list', ['q'=>$child ])
	    @endforeach
	    </ul>
	@endif