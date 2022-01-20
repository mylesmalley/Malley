{{--
    Home page for an individual count
--}}
@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class=""><a href="{{ route('inventory_count.home', [$inventory]) }}">
            {{ $inventory->description }}
        </a></h1>

    @includeIf('syspro::InventoryCounts.errors')

    <div class="row">
        <div class="col-6">
            <ul>
                <li><a href="{{ url('syspro/inventory/'.$inventory->id.'/all') }}">Show All ({{ $total }} Items)</a></li>
                <li><a href="{{ url('syspro/inventory/'.$inventory->id.'/allPaginated') }}">Show All  {{ $total }} Items, 50 at a time</a></li>
                {{--        <li><a href="#">Never Counted ({{ $neverCounted }})</a></li>--}}
                {{--        <li><a href="#">Needs Recount ({{ $needsRecount }})</a></li>--}}

                <li><a href="{{ url('syspro/inventory/'.$inventory->id.'/allNeedingRecount') }}">Items Needing Recount ({{ $needsRecount }} Items)</a></li>
                <li><a href="{{ url('syspro/inventory/'.$inventory->id.'/allNeedingRecountPaginated') }}">Items Needing Recount,  {{ $needsRecount }} Items, 50 at a time</a></li>


                <li><a href="{{ route("inventory_counts.create_custom_item", [$inventory]) }}">Enter Blank Ticket</a></li>
            </ul>
        </div>
        <div class="col-6">
            <ul>
                @if (Auth::user()->inventory_admin)
                    <li><a href="{{ url('syspro/inventory/'.$inventory->id.'/customTickets') }}">Create Custom Tickets</a></li>

                    <li><a href="{{ url('syspro/inventory/'.$inventory->id.'/progress') }}">Count Progress Report</a></li>


                    <li><a href="{{ route('inventory_counts.update_cache', [$inventory]) }}">Update Caches</a></li>
                @endif
            </ul>
        </div>

    </div>






    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Group</th>
                    <th class="table-secondary">Total Items</th>
                    <th class="table-warning">Not Yet Counted</th>
                    <th class="table-danger">Needing Recount</th>
                    @if (Auth::user()->inventory_admin)
                        <th class="table-info">Variance</th>
                    @endif
                    <th class="table-success">Accepted</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $groups as $group)
                    <tr>
                        <td>{{ $group['name'] }}</td>
                        <td class="table-secondary">

                        <a
                            class="btn btn-secondary"
                            href="{{ url("syspro/inventory/{$inventory->id}/search/group/for/{$group['name']}/All") }}">
                            See All ( {{ $group['totalItems'] }} )
                        </a>
                        </td>
                        <td class="table-warning">
                            <a
                                class="btn btn-warning"
                                href="{{ url("syspro/inventory/{$inventory->id}/search/group/for/{$group['name']}/Not Counted") }}">
                                See Not Counted {{ $group['notCounted'] }} ({{ $group['notCountedPercentage'] }}%)
                            </a>

                            </td>
                        <td class="table-danger">
                            <a
                                class="btn btn-danger"
                                href="{{ url("syspro/inventory/{$inventory->id}/search/group/for/{$group['name']}/Needs Recount") }}">
                                Needs Recount {{ $group['needingRecount'] }} ({{ $group['needingRecountPercentage'] }}%)
                            </a>

                        @if (Auth::user()->inventory_admin)
                            <td class="table-info">
                                <a
                                    class="btn btn-info"
                                    href="{{ url("/syspro/inventory/{$inventory->id}/VarianceAcceptanceReport/". $group['name']) }}">
                                    Variance
                                </a>

                            </td>
                            @endif

                            </td>
                        <td class="table-success">{{ $group['accepted'] }} ({{ $group['acceptedPercentage'] }}%)</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>TOTALS</td>
                    <td class="table-secondary">{{ $groupsTotals['totalItems'] }}</td>
                    <td class="table-warning">
                        @if( $groupsTotals['totalItems'] )

                        {{ $groupsTotals['totalNotCounted'] }} ({{ number_format( ($groupsTotals['totalNotCounted'] / $groupsTotals['totalItems'])) * 100 }}%)
                    @endif

                    </td>
                    <td class="table-danger">
                        @if( $groupsTotals['totalItems'] )

                        {{ $groupsTotals['totalNeedingRecount'] }} ({{ number_format( ($groupsTotals['totalNeedingRecount'] / $groupsTotals['totalItems'])) * 100 }}%)
                   @endif
                    </td>
                    @if (Auth::user()->inventory_admin)
                        <td class="table-info">


                        </td>
                    @endif
                    <td class="table-success">
                        @if( $groupsTotals['totalItems'] )

                        {{ $groupsTotals['totalAccepted'] }} ({{ number_format( ($groupsTotals['totalAccepted'] / $groupsTotals['totalItems'])) * 100 }}%)
                        @endif

                    </td>


                </tr>
                </tfoot>
            </table>
        </div>
    </div>





{{--    <h1>Value</h1>--}}
{{--        <ul>--}}
{{--            <li>Expected Value: {{ number_format( $totalValueExpected, 2) }}</li>--}}
{{--            <li>Counted Value: {{  number_format( $totalValueCounted, 2) }}</li>--}}
{{--            <li>Total Variance: {{  number_format( $totalValueExpected - $totalValueCounted, 2) }}</li>--}}
{{--        </ul>--}}


{{--    <h1>Progress By Group</h1>--}}

{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <table class="table table-striped">--}}
{{--                <thead>--}}
{{--                    <tr>--}}
{{--                        <th>Group</th>--}}
{{--                        <th class="table-secondary">Total Items</th>--}}
{{--                        <th class="table-warning">Not Yet Counted</th>--}}
{{--                        <th class="table-danger">Needing Recount</th>--}}
{{--                        <th class="table-success">Accepted</th>--}}
{{--                        <th>Total Expected Value</th>--}}
{{--                        <th class="">Value Counted</th>--}}
{{--                        <th>Variance</th>--}}

{{--                    </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                    @foreach( $groups as $group)--}}
{{--                        <tr>--}}
{{--                            <td>{{ $group['name'] }}</td>--}}
{{--                            <td class="table-secondary">{{ $group['totalItems'] }}</td>--}}
{{--                            <td class="table-warning">{{ $group['notCounted'] }} ({{ $group['notCountedPercentage'] }}%)</td>--}}
{{--                            <td class="table-danger">{{ $group['needingRecount'] }} ({{ $group['needingRecountPercentage'] }}%)</td>--}}
{{--                            <td class="table-success">{{ $group['accepted'] }} ({{ $group['acceptedPercentage'] }}%)</td>--}}
{{--                            <td>{{ number_format( $group['expectedValue'] ) }}</td>--}}
{{--                            <td>{{ $group['valueCounted'] }} </td>--}}
{{--                            <td>{{ $group['variance'] }}</td>--}}
{{--                        </tr>--}}
{{--                    @endforeach--}}
{{--                </tbody>--}}
{{--                <tfoot>--}}
{{--                    <tr>--}}
{{--                        <td>TOTALS</td>--}}
{{--                        <td class="table-secondary">{{ $groupsTotals['totalItems'] }}</td>--}}
{{--                        <td class="table-warning">--}}
{{--                            {{ $groupsTotals['totalNotCounted'] }} ({{ number_format( ($groupsTotals['totalNotCounted'] / $groupsTotals['totalItems'])) * 100 }}%)--}}
{{--                        </td>--}}
{{--                        <td class="table-danger">--}}
{{--                            {{ $groupsTotals['totalNeedingRecount'] }} ({{ number_format( ($groupsTotals['totalNeedingRecount'] / $groupsTotals['totalItems'])) * 100 }}%)--}}
{{--                        </td>--}}

{{--                        <td class="table-success">--}}
{{--                            {{ $groupsTotals['totalAccepted'] }} ({{ number_format( ($groupsTotals['totalAccepted'] / $groupsTotals['totalItems'])) * 100 }}%)--}}

{{--                        </td>--}}
{{--                        <td>{{ number_format($groupsTotals['totalValue']) }}</td>--}}

{{--                        <td>$ {{ number_format( $groupsTotals['totalValueCounted'], 0) }}</td>--}}
{{--                        <td>$ {{ number_format($groupsTotals['totalVariance'], 0) }}--}}
{{--                            ({{ number_format( ($groupsTotals['totalValueCounted'] / $groupsTotals['totalValue'])) * 100 }}%)--}}
{{--                        </td>--}}
{{--                    </tr>--}}
{{--                </tfoot>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}






{{--    <h1>Progress By Warehouse</h1>--}}

{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <table class="table table-striped">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>Warehouse</th>--}}
{{--                    <th class="table-secondary">Total Items</th>--}}
{{--                    <th class="table-warning">Not Yet Counted</th>--}}
{{--                    <th class="table-danger">Needing Recount</th>--}}
{{--                    <th class="table-success">Accepted</th>--}}
{{--                    <th>Total Expected Value</th>--}}
{{--                    <th class="">Value Counted</th>--}}
{{--                    <th>Variance</th>--}}

{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach( $warehouses as $warehouse)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $warehouse['name'] }}</td>--}}
{{--                        <td class="table-secondary">{{ $warehouse['totalItems'] }}</td>--}}
{{--                        <td class="table-warning">{{ $warehouse['notCounted'] }} ({{ $warehouse['notCountedPercentage'] }}%)</td>--}}
{{--                        <td class="table-danger">{{ $warehouse['needingRecount'] }} ({{ $warehouse['needingRecountPercentage'] }}%)</td>--}}
{{--                        <td class="table-success">{{ $warehouse['accepted'] }} ({{ $warehouse['acceptedPercentage'] }}%)</td>--}}
{{--                        <td>{{ number_format( $warehouse['expectedValue'] ) }}</td>--}}
{{--                        <td>{{ $warehouse['valueCounted'] }} </td>--}}
{{--                        <td>{{ $warehouse['variance'] }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--                    <td>TOTALS</td>--}}
{{--                    <td class="table-secondary">{{ $warehousesTotals['totalItems'] }}</td>--}}
{{--                    <td class="table-warning">--}}
{{--                        {{ $warehousesTotals['totalNotCounted'] }} ({{ number_format( ($warehousesTotals['totalNotCounted'] / $warehousesTotals['totalItems'])) * 100 }}%)--}}
{{--                    </td>--}}
{{--                    <td class="table-danger">--}}
{{--                        {{ $warehousesTotals['totalNeedingRecount'] }} ({{ number_format( ($warehousesTotals['totalNeedingRecount'] / $warehousesTotals['totalItems'])) * 100 }}%)--}}
{{--                    </td>--}}

{{--                    <td class="table-success">--}}
{{--                        {{ $warehousesTotals['totalAccepted'] }} ({{ number_format( ($warehousesTotals['totalAccepted'] / $warehousesTotals['totalItems'])) * 100 }}%)--}}

{{--                    </td>--}}
{{--                    <td>{{ number_format($warehousesTotals['totalValue']) }}</td>--}}

{{--                    <td>$ {{ number_format( $warehousesTotals['totalValueCounted'], 0) }}</td>--}}
{{--                    <td>$ {{ number_format($warehousesTotals['totalVariance'], 0) }}--}}
{{--                        ({{ number_format( ($warehousesTotals['totalValueCounted'] / $warehousesTotals['totalValue'])) * 100 }}%)--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}





{{--    <h1>Progress By Locale</h1>--}}

{{--    <div class="row">--}}
{{--        <div class="col-md-12">--}}
{{--            <table class="table table-striped">--}}
{{--                <thead>--}}
{{--                <tr>--}}
{{--                    <th>locale</th>--}}
{{--                    <th class="table-secondary">Total Items</th>--}}
{{--                    <th class="table-warning">Not Yet Counted</th>--}}
{{--                    <th class="table-danger">Needing Recount</th>--}}
{{--                    <th class="table-success">Accepted</th>--}}
{{--                    <th>Total Expected Value</th>--}}
{{--                    <th class="">Value Counted</th>--}}
{{--                    <th>Variance</th>--}}

{{--                </tr>--}}
{{--                </thead>--}}
{{--                <tbody>--}}
{{--                @foreach( $locales as $locale)--}}
{{--                    <tr>--}}
{{--                        <td>{{ $locale['name'] }}</td>--}}
{{--                        <td class="table-secondary">{{ $locale['totalItems'] }}</td>--}}
{{--                        <td class="table-warning">{{ $locale['notCounted'] }} ({{ $locale['notCountedPercentage'] }}%)</td>--}}
{{--                        <td class="table-danger">{{ $locale['needingRecount'] }} ({{ $locale['needingRecountPercentage'] }}%)</td>--}}
{{--                        <td class="table-success">{{ $locale['accepted'] }} ({{ $locale['acceptedPercentage'] }}%)</td>--}}
{{--                        <td>{{ number_format( $locale['expectedValue'] ) }}</td>--}}
{{--                        <td>{{ $locale['valueCounted'] }} </td>--}}
{{--                        <td>{{ $locale['variance'] }}</td>--}}
{{--                    </tr>--}}
{{--                @endforeach--}}
{{--                </tbody>--}}
{{--                <tfoot>--}}
{{--                <tr>--}}
{{--                    <td>TOTALS</td>--}}
{{--                    <td class="table-secondary">{{ $localesTotals['totalItems'] }}</td>--}}
{{--                    <td class="table-warning">--}}
{{--                        {{ $localesTotals['totalNotCounted'] }} ({{ number_format( ($localesTotals['totalNotCounted'] / $localesTotals['totalItems'])) * 100 }}%)--}}
{{--                    </td>--}}
{{--                    <td class="table-danger">--}}
{{--                        {{ $localesTotals['totalNeedingRecount'] }} ({{ number_format( ($localesTotals['totalNeedingRecount'] / $localesTotals['totalItems'])) * 100 }}%)--}}
{{--                    </td>--}}

{{--                    <td class="table-success">--}}
{{--                        {{ $localesTotals['totalAccepted'] }} ({{ number_format( ($localesTotals['totalAccepted'] / $localesTotals['totalItems'])) * 100 }}%)--}}

{{--                    </td>--}}
{{--                    <td>{{ number_format($localesTotals['totalValue']) }}</td>--}}

{{--                    <td>$ {{ number_format( $localesTotals['totalValueCounted'], 0) }}</td>--}}
{{--                    <td>$ {{ number_format($localesTotals['totalVariance'], 0) }}--}}
{{--                        ({{ number_format( ($localesTotals['totalValueCounted'] / $localesTotals['totalValue'])) * 100 }}%)--}}
{{--                    </td>--}}
{{--                </tr>--}}
{{--                </tfoot>--}}
{{--            </table>--}}
{{--        </div>--}}
{{--    </div>--}}





    <div class="row">
{{--        <div class="col-md-3">--}}

{{--            <div class="card" >--}}
{{--                <div class="card-header">--}}
{{--                    Groups--}}
{{--                </div>--}}
{{--                <ul class="list-group list-group-flush">--}}
{{--                    @foreach( $groups as $k => $group )--}}
{{--                        <li class="list-group-item">--}}
{{--                            <a href="{{ url('syspro/inventory/'.$inventory->id.'/report?filter=group&by='.$group->group) }}">{{ $group->group ?? 'not set' }}</a>--}}
{{--                        </li>--}}

{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--        </div>--}}


{{--        <div class="col-md-3">--}}

{{--            <div class="card" >--}}
{{--                <div class="card-header">--}}
{{--                    Locales--}}
{{--                </div>--}}
{{--                <ul class="list-group list-group-flush">--}}
{{--                    @foreach( $locales as $k => $locale )--}}
{{--                        <li class="list-group-item">--}}
{{--                            <a href="{{ url('syspro/inventory/'.$inventory->id.'/report?filter=locale&by='.$locale->locale) }}">{{ $locale->locale ?? "not set" }}</a>--}}
{{--                        </li>--}}

{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--        </div>--}}



{{--        <div class="col-md-3">--}}

{{--            <div class="card" >--}}
{{--                <div class="card-header">--}}
{{--                    Warehouses--}}
{{--                </div>--}}
{{--                <ul class="list-group list-group-flush">--}}
{{--                    @foreach( $warehouses as $k => $warehouse )--}}
{{--                        <li class="list-group-item">--}}
{{--                            <a href="{{ url('syspro/inventory/'.$inventory->id.'/report?filter=warehouse&by='.$warehouse->warehouse) }}">{{ $warehouse->warehouse ?? 'missing' }}</a>--}}
{{--                        </li>--}}

{{--                    @endforeach--}}
{{--                </ul>--}}
{{--            </div>--}}

{{--        </div>--}}

    </div>

    <a href="{{ url('syspro/inventory/') }}"
       class="uk-button uk-button-secondary">Back to Counts</a>
@endsection
