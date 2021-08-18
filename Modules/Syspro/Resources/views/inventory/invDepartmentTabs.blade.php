<div class="blueprint-tabs">
	<ul>
		<li>
			<a {!!   $selected === 'EL' ? "class='blueprint-tabs-active'":'' !!}
			   href="/syspro/inventory/{{ $path ?? 'onorder' }}/EL" >
				Electrical </a>
			<a href="/syspro/inventory/{{ $path ?? 'onorder' }}/MF"
					{!! $selected === 'MF' ? "class='blueprint-tabs-active'":'' !!}>
				MetalFab</a>
			<a href="/syspro/inventory/{{ $path ?? 'onorder' }}/PL"
					{!! $selected === 'PL' ? "class='blueprint-tabs-active'":'' !!} >
				Plastics</a>
			<a href="/syspro/inventory/{{ $path ?? 'onorder' }}/MIL"
					{!! $selected === 'MIL' ? "class='blueprint-tabs-active'":'' !!} >
				Mill</a>
			<a href="/syspro/inventory/{{ $path ?? 'onorder' }}/UPH"
					{!! $selected === 'UPH' ? "class='blueprint-tabs-active'":'' !!} >
				Upholstery</a>
			<a href="/syspro/inventory/{{ $path ?? 'onorder' }}/DEC"
					{!! $selected === 'DEC' ? "class='blueprint-tabs-active'":'' !!} >
				Graphics</a>
		</li>
	</ul>
</div>
