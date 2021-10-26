<div class="options-box">


<ul>
	@forelse( $configurations as $config)
{{--		@if(!$config->option || $config->option->option_show_on_quote )--}}
			<li>
				@if (isset($showBoxes) && $showBoxes)
				<span class="signoff">&nbsp;QA&nbsp;</span>
				<span class="signoff">Prod</span>
				@endif
				
				@if ( $config->option )
				<a href="http://index.malleyindustries.com/index/option/{{ $config->option->id }}"><b>{{ $config->option->option_name  }}</b></a>
						&nbsp;-&nbsp;{{ $config->option->option_description }} &nbsp; <img style="width:16px;height:16px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAQAAAAEABAMAAACuXLVVAAAAHlBMVEUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAC3KG9qAAAACXRSTlMAEDBAcJG/z+/mH+7/AAAAwElEQVR42u3csQmAQBREwUPQepQrwU4MBBsQLMHYyG5NTQQPPofCvAom3WRTkiRJkqQv1c5Vmh4B3VmlAwAAAAAAAAAAAADgJ4AxR7aVA/rQ0bUAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAJQD1tCj7N09IAAAAAAAAAAAAADAK0CTqzQkSZIkSbp1AZsdIfcFGotPAAAAAElFTkSuQmCC" alt="signoff" />


					@else
					{{ $config->name }}
						&nbsp;-&nbsp;{{ $config->description }}
					
					@endif
{{--				<img width="20" src="data:image/png;base64,{!!  DNS2D::getBarcodePNG($config->option->id, "QRCODE", 10, 10) !!}" alt="barcode"   />--}}
				@if ( $config->notes )
					<br />
					<span class="notes">{{ $config->notes }}</span>
				@endif
				
			</li>
{{--		@endif--}}
	@empty
		<li>No options selected</li>

	@endforelse
</ul>
</div>