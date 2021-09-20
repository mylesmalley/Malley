<div style="width:5in; float:left;">
	<h2>Affecting Options</h2>
	<ul>
		@foreach( $configurations as $config)
			@if( $config->option && $config->option->option_show_on_quote )
				<li><b>{{ $config->option->option_name  }}</b>&nbsp;-&nbsp;{{ $config->option->option_description }}
					@if ( $config->notes )
						<br />
						<span class="notes"><b>Affected Phatom: {{ $config->option->option_syspro_phantom }}</b><br />
							{{ $config->notes }}</span>
					@endif
					
				</li>
			@endif
		@endforeach
	</ul>
</div>

<div style="width:5in; float:left;">
	<h2>General Notes</h2>
	<dl>
	
	@foreach( $notes as $title => $note)
		@if( $note )
			<dt>
				{{ ucwords( str_replace( '_', ' ', $title ) ) }}
			</dt>
			<dd>
				{{ $note }}
			</dd>
		@endif
	@endforeach
	</dl>

</div>