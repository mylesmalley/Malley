<option value="{{ $album->id }}"> {!!  str_repeat("&nbsp;&nbsp;", $album->depth) !!} {{ $album->name }} </option>
@if ( count($album->children) )
	@foreach($album->children as $child)
		@include('index::albums.partials.menu', ['album'=>$child ])
	@endforeach
@endif

