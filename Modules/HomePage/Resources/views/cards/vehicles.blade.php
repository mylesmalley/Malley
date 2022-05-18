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

    <br>

    <div class="card" style="border: 1px solid #901d1d;">
        <div class="card-header text-white " style="background-color: #901d1d;">
            Bodyguard
        </div>
        <ul class="list-group list-group-flush">
            <li class="list-group-item">
                <a href="{{ route('bg.kits.home') }}" >Parts </a>
            </li>
        </ul>
    </div>

</div>
