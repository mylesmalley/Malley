<div class="col-md-6">
	<div class="card">
		<div class="card-header bg-primary text-white">
			Recent Blueprints
		</div>
		<ul class="list-group list-group-flush">
			@foreach( $blueprints as $blueprint )
				<li class="list-group-item">
					<a href="https://blueprint.malleyindustries.com/blueprint/{{ enc($blueprint->id) }}">B-{{ $blueprint->id }} -
						{{ $blueprint->name }} - by {{ $blueprint->user->first_name . ' ' . $blueprint->user->last_name }}
						at {{ $blueprint->user->company->name }}
					</a>
				</li>
			@endforeach


		</ul>
	</div>
</div>
