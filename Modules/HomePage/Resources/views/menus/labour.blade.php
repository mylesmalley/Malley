@canany(['labour_clock_in', 'labour_edit' ])
    <li class="nav-item dropdown has-megamenu">
        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"> Labour </a>
        <div class="dropdown-menu megamenu" role="menu">
            <h3>Labour</h3>
            <div class="row">

                @can(['labour_clock_in'])
                    <div class="col-md-3">
                        <h4>Me</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                                href="{{ route('labour.home') }}">Clock In &amp; Out of Jobs</a>
                        </div>
                    </div>
                @endcan


                @can('labour_edit')
                    <div class="col-md-3">
                        <h4>Managing Labour</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                                href="{{ route('labour.reports.clocked_in') }}">Clocked In Staff</a>

                            <a class="list-group-item list-group-item-action"
                                href="{{ route('labour.management.home') }}">See and Make Changes to Labour </a>
                        </div>
                    </div>

                    <div class="col-3">
                        <h4>Reports</h4>
                        <div class="list-group">
                            <a class="list-group-item list-group-item-action"
                               href="{{ route('labour.reports.labour_on_job') }}">Labour on Job</a>

                        </div>
                    </div>
                @endcan

            </div>


        </div>

    </li>
@endcanany
