<li class="nav-item dropdown has-megamenu">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Vehicles </a>
    <div class="dropdown-menu megamenu" role="menu">
        <h3>Vehicles and Logistics</h3>
        <div class="row">
            <div class="col-md-3">

                <h4>Look Up</h4>

                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/vehicles/search') }}">Search Vehicles</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/vehicles') }}">See All Vehicles</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/vehicles/dealers') }}">List of Dealers</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/vehicles/create') }}">Add a Vehicle</a>
                </div>

                <h4>Blank Forms</h4>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/vehicles/3086') }}">Create Blank Forms and Work Orders</a>
                </div>
            </div>




            <div class="col-md-3">
                <h4>Reports</h4>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                        href="{{ url("/vehicles/reports/productionBuildList" ) }}">
                        Production Build List</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url("/vehicles/reports/transitionReport" ) }}">
                        Transition Report</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url("/vehicles/reports/USChassisInCanadaReport" ) }}">
                        US Chassis in Canada</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url("/vehicles/reports/atThorntonOrYork" ) }}">
                        Chassis at York and Thornton</a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ route("inspection.report" ) }}">
                        Inspection Report</a>
                </div>

                <br>

                <h4>Warranty Claims</h4>
                <div class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                       href="{{ route('warranty_claim_index') }}">
                        Warranty Claims Index</a>
                </div>

            </div>








            <div class="col-md-6">
            <h4>Vehicles By Type</h4>
            <div class="row">
                <div class="col-sm-6">
                    <h6>Ambulances</h6>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action"
                            href="{{ url("/vehicles/category/AAL/A0/".urlencode("Advanced Life Support") ) }}">
                                Advanced Life Support
                            </a>
                        <a class="list-group-item list-group-item-action"
                            href="{{ url("/vehicles/category/ABL/ABLS/".urlencode("Basic Life Support") ) }}">
                                Basic Life Support
                            </a>
                        <a class="list-group-item list-group-item-action"
                            href="{{ url("/vehicles/category/R0/ARP/".urlencode("Ambulance Repairs") ) }}">
                                Repairs
                            </a>
                        <a class="list-group-item list-group-item-action"
                            href="{{ url("/vehicles/category/ARF/R0/".urlencode("Ambulance Refurbs") ) }}">
                                Ambulance Refurbs
                            </a>
                    </div>

                    <h6>Commercial &amp; Other</h6>

                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action"
                            href="{{ url("/vehicles/category/CUF/UF0/".urlencode("Commercial Upfits") ) }}">
                                Commercial Upfits
                            </a>
                        <a class="list-group-item list-group-item-action"
                            href="{{ url("/vehicles/category/FRV/FR1/".urlencode(" First Responder Vehicles") ) }}">
                                First Responder Vehicles
                            </a>
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/DLE/DS0/".urlencode("Defence and Law Enforcement") ) }}">
                                Defence &amp; Law Enforcement
                            </a>
                    </div>






                </div>

                <div class="col-sm-6">
                    <h6>Mobility</h6>
                    <div class="list-group list-group-flush">
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/MTC/LF1/".urlencode("Transit Connect Lowered Floor") ) }}">
                                Transit Connect Lowered Floor
                            </a>
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/MRE/MCA/".urlencode("Caravan Lowered Floor") ) }}">
                                Caravan Lowered Floor
                            </a>
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/MPT/MO0/".urlencode("Para-Transit") ) }}">
                                Para-Transit
                            </a>
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/MOS/OUT/".urlencode("Mobility Outsourced") ) }}">
                                Mobility Outsourced
                            </a>
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/MRP/RM0/".urlencode("Mobility Repairs") ) }}">
                                Mobility Repairs
                            </a>
                        <a class="list-group-item list-group-item-action"
                           href="{{ url("/vehicles/category/MAE/MAE/".urlencode("Mobility Equipment") ) }}">
                                Mobility Equipment
                            </a>
                    </div>


                </div>



            </div>
        </div>
        </div>
    </div>
</li>


