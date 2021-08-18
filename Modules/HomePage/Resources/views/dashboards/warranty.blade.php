<div class="col-md-6">
	<div class="card">
		<div class="card-header bg-danger text-white">
			Recent Warranty Claims
            <a href="{{ url('/warranty') }}" class="float-right text-white">See All</a>
		</div>
		<ul class="list-group list-group-flush">
			@foreach( $claims as $claim )
				<li class="list-group-item">
                    <a href="{{ url('/warranty/'.$claim->id) }}">
					#{{ $claim->id }} - {{ substr( $claim->issue, 0 , 100) }}... submitted by {{ $claim->first_name }}
					at {{ $claim->organization  }}
                    </a>
				</li>
			@endforeach


		</ul>
	</div>
</div>
