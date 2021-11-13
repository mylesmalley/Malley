<li class="nav-item dropdown has-megamenu">
    <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Engineering </a>
    <div class="dropdown-menu megamenu" role="menu">
        <h3>Engineering</h3>


        <div class="row">

            <div class="col-md-3">
                <h4>Issue Tracker</h4>

                <div class="list-group">
                    @if (Auth::user() )
                        <a class="list-group-item list-group-item-action"
                           href="{{ url('bugs/user/'.Auth::user()->id ) }}">My Assigned Tasks</a>
                    @endif
                        <a class="list-group-item list-group-item-action"
                           href="{{ url('bugs/all/engineering') }}">Open Engineering Projects</a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('https://index.malleyindustries.com/bugs/engineering') }}">New Engineering Project</a>

                </div>


                <h4>Blueprint Bug Reports</h4>

                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('https://blueprint.malleyindustries.com/bugs/create') }}">New Blueprint Issue</a>

                    <a class="list-group-item list-group-item-action"
                        href="{{ url('bugs/all/blueprint') }}">Open Blueprint Issues</a>

                </div>
            </div>



            <div class="col-md-3">
                <h4>Ambulance Indexes</h4>

                <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/index/basevan/3') }}" >Ford Transit Ambulance  </a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/index/basevan/16') }}" >Ram ProMaster Ambulance  </a>
                </div>

                <h4>Mobility Indexes</h4>

                    <div class="list-group">
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/index/basevan/4') }}" >Ford Transit Connect Mobility  </a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/index/basevan/14') }}" >Grand Caravan Mobility  </a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/index/basevan/12') }}" >Ram ProMaster Mobility  </a>
                    <a class="list-group-item list-group-item-action"
                       href="{{ url('/index/basevan/11') }}" >Ford Transit Mobility  </a>
                </div>

                <h4>Test Indexes</h4>

                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('platform.home', [31]) }}" >BLS Transit </a>
                    <a class="list-group-item list-group-item-action"
                        href="{{ url('/index/basevan/10') }}" >Tests </a>
                </div>

            </div>

            <div class="col-md-3">
                <h4>Engineering Change Requests</h4>

                <ul class="list-group list-group-flush">
                    <a class="list-group-item list-group-item-action"
                        href="#" >New ECN </a>
                    <a class="list-group-item list-group-item-action"
                         href="#" >See ECNs  </a>
                </ul>

            </div>

        </div>







    </div>






</li>

