@canany(['manage_general_users','manage_production_staff', 'manage_companies'])
    <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Admin </a>
        <div class="dropdown-menu megamenu" role="menu">
            <h3>Managing Users</h3>
            <div class="row">

                @can(['manage_general_users'])
                    <div class="col-md-3">
                        <h4>Blueprint and Index Users</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('users.index') }}">See All</a>
                        </div>
                    </div>
                @endcan


                @can('manage_production_staff')
                    <div class="col-md-3">
                        <h4>Production Staff</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('staff.index') }}">See All</a>

                            <a class="list-group-item list-group-item-action"
                                 href="{{ route('staff.create') }}">Add New Production Staff</a>
                        </div>
                    </div>
                @endcan

                @can('manage_companies')
                    <div class="col-md-3">
                        <h4>Companies</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('companies.index') }}">See All</a>
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('companies.create') }}">Create New Company</a>
                        </div>
                    </div>
                @endcan


            </div>


        </div>

    </li>
@endcanany
