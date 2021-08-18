<div class="blueprint-tabs">
	<ul>
		<li>
			<a {!!   $selected === 'options' ? "class='blueprint-tabs-active'":'' !!}
			    href="/basevan/{{ $platform->id }}" >
				Options </a>
			<a href="/basevan/{{ $platform->id }}/layouts"
				{!! $selected === 'layouts' ? "class='blueprint-tabs-active'":'' !!}>
				Layouts</a>
			<a href="/basevan/{{ $platform->id }}/templates"
					{!! $selected === 'templates' ? "class='blueprint-tabs-active'":'' !!} >
				Blueprint Templates</a>
			<a href="/basevan/{{ $platform->id }}/forms"
				{!! $selected === 'forms' ? "class='blueprint-tabs-active'":'' !!} >
				Blueprint Forms</a>
			
			@if ( Auth::user()->show_sales_in_index == true )
				<a href="/sales/{{ $platform->id }}/pricelist"
						{!! $selected === 'pricelist' ? "class='blueprint-tabs-active'":'' !!} >
					Price List</a>
				<a href="/sales/{{ $platform->id }}/priceListWithoutOffset"
						{!! $selected === 'priceedit' ? "class='blueprint-tabs-active'":'' !!} >
					Edit Pricing</a>
			@endif
		</li>
	</ul>
</div>