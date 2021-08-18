<li class="nav-item dropdown has-megamenu">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Inventory </a>
    <div class="dropdown-menu megamenu" role="menu">
        <h3>Inventory &amp; Purchasing</h3>


        <div class="row">
            <div class="col-md-3">
                <h4>Inventory</h4>

                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/syspro/inventoryQuery/search') }}" >Syspro Query  </a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/syspro/inventory/recentdeliveries/EL') }}" >Recent Deliveries  </a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/syspro/inventory/openPartsBuildOrders/EL') }}" >Open PB Orders</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/syspro/inventory/finishedGoods') }}" >Finished Plastic Parts</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/syspro/vinreport') }}" >VIN Allocations By Job</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('syspro/JobCostChecker') }}" >Job Cost Checker Report</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('syspro/BOMCoster') }}" >BOM Cost Calculator</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('JobTrialKit') }}" > Job Trial Kit</a>
                </div>

            </div>


            <div class="col-md-3">
                <h4>Purchasing</h4>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/syspro/purchasing/openRequests') }}" >Part Order Requests (NEW!)</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/syspro/inventory/onorder/EL') }}" >What's On Order (By Department) </a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/syspro/inventory/recentdeliveries/EL') }}" >Recent Deliveries ( By Department </a>
                </div>
            </div>

        </div>

    </div>






</li>

