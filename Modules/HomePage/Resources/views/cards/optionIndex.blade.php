<div class="col-md-3">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white ">
			Option Index
		</div>
			<ul class="list-group list-group-flush">
				@foreach( $baseVans as $base )
                    <li class="list-group-item">
                        <a href="/index/basevan/{{ $base->id }}">{{ $base->name }}</a>
                    </li>
                @endforeach
			</ul>
	</div>
</div>
