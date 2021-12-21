<div class="col-md-3">
	<div class="card border-primary">
        <div class="card-header bg-primary text-white ">
			Inventory
		</div>
		<ul class="list-group list-group-flush">

            <li class="list-group-item">
                <a class="" href="/syspro/inventoryQuery/search" >Syspro Query  </a>
            </li>

{{--            <li class="list-group-item bg-warning text-white">--}}
{{--                <a  href="/syspro/inventory/14" >2020 Year End </a>--}}
{{--            </li>--}}

            <li class="list-group-item">
                <a  href="/syspro/inventory" >Inventory Counts  </a>
            </li>



{{--			<li class="list-group-item">--}}
{{--				<a href="/syspro/inventoryQuery/" >Look up a Part Number  </a>--}}
{{--			</li>--}}
			<li class="list-group-item">
				<a href="/syspro/inventory/recentdeliveries/EL" >Recent Deliveries  </a>
			</li>
			<li class="list-group-item">
				<a href="/syspro/inventory/openPartsBuildOrders/EL" >Open PB Orders</a>
			</li>
			<li class="list-group-item">
				<a href="/syspro/inventory/finishedGoods" >Finished Plastic Parts</a>
			</li>
			<li class="list-group-item">
				<a href="/syspro/vinreport" >VIN Allocations By Job</a>
			</li>
            <li class="list-group-item">
                <a href="{{ url('syspro/JobCostChecker') }}" >Job Cost Checker Report</a>
            </li>
            <li class="list-group-item">
                <a href="{{ url('syspro/BOMCoster') }}" >BOM Cost Calculator</a>
            </li>
            <li class="list-group-item">
                <a href="{{ route('JobTrialKit') }}" > Job Trial Kit</a>
            </li>
		</ul>
	</div>


</div>
