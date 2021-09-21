@canany(['blueprint.create' ])

        <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Blueprint </a>
        <div class="dropdown-menu megamenu" role="menu">
            <h3>Blueprint &amp; Resources</h3>


            <div class="row">
                <div class="col-3">
                    <h4>Quick Links</h4>

                    <div class="list-group">
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('my_blueprints') }}">My Blueprints</a>
                    </div>
                </div>


                <div class="col-3">
                    <h4>Create New Blueprints</h4>
                    <div class="list-group">
                        <a class="list-group-item list-group-item-action"
                           href="{{ route('blueprint.create', [11]) }}">Transit Mobility</a>
                    </div>
                </div>


            </div>


        </div>






    </li>

@endcanany