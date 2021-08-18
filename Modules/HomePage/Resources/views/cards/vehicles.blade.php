<div class="col-md-3">
    <div class="card border-primary">
        <div class="card-header bg-primary text-white ">
			Vehicles
		</div>
		<ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ url('/vehicles/search') }}">Search Vehicles</a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('/vehicles/reports/productionBuildList') }}">Ambulance Build List</a>
            </li>
			<li class="list-group-item">
                <a href="{{ url('/vehicles') }}">See All Vehicles</a>
			</li>
            <li class="list-group-item">
                <a href="{{ url('/vehicles/create') }}">Add a Vehicle</a>
            </li>
		</ul>
	</div>
</div>
