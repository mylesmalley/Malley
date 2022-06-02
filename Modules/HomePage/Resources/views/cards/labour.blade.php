<div class="col-md-3">
    <div class="card border-success">
        <div class="card-header bg-success text-white ">
			Labour Tracking
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<a href="{{ route('labour.login') }}" >Labour Log In</a>
			</li>
			<li class="list-group-item">
				<a href="{{ route('labour.management.home') }}" >Labour Management</a>
			</li>
			<li class="list-group-item">
				<a href="{{ route('labour.reports.all_jobs') }}" >Look up Labour on Jobs</a>
			</li>
		</ul>
	</div>
	<br>

	<div class="card border-primary">
		<div class="card-header bg-primary text-white ">
			Purchasing
		</div>
		<ul class="list-group list-group-flush">
			<li class="list-group-item">
				<a href="{{ url('/syspro/purchasing/openRequests') }}" >Part Order Requests (NEW!)</a>
			</li>
			<li class="list-group-item">
				<a href="{{ url('/syspro/inventory/onorder/EL') }}" >What's On Order (By Department) </a>
			</li>
			<li class="list-group-item">
				<a href="{{ url('/syspro/inventory/recentdeliveries/EL') }}" >Recent Deliveries ( By Department </a>
			</li>


		</ul>
	</div>
</div>
