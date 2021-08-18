@foreach($passed_data as $option)
    @if ( array_key_exists($option, $selected) )
		<p><span class='initials'>P</span>&nbsp;<span class='initials'>QA</span>&nbsp;<strong>{{ $option }}</strong> -   {{ $selected[$option]->description }}</p>
    @endif
@endforeach