{{--
    Home page for an individual count
--}}
@extends('syspro::InventoryCounts.template')

@section('content')

    <h1 class="">{{ $inventory->description }}</h1>


    <h1>Count Progress</h1>

    <a href="{{ url('syspro/inventory/'.$inventory->id) }}"
       class="btn btn-dark btn-lg">Back to the Count</a>

    <h2>Summary</h2>
        <ul>
            <li>Expected Value: {{ number_format( $totalValueExpected, 2) }}</li>
            <li>Counted Value: {{  number_format( $totalValueCounted, 2) }}</li>
            <li>Total Variance: {{  number_format( $totalValueExpected - $totalValueCounted, 2) }}</li>
        </ul>


    <h2>Progress By Group</h2>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Group</th>
                        <th class="table-secondary">Total Items</th>
                        <th class="table-warning">Not Yet Counted</th>
                        <th class="table-danger">Needing Recount</th>
                        <th class="table-success">Accepted</th>
                        <th  style="text-align: right;">Total Expected Value</th>
                        <th  style="text-align: right;" class="">Value Counted</th>
                        <th style="text-align: right;">Variance</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach( $groups as $group)
                        <tr>
                            <td>{{ $group['name'] }}</td>
                            <td class="table-secondary">{{ $group['totalItems'] }}</td>
                            <td class="table-warning">{{ $group['notCounted'] }} ({{ $group['notCountedPercentage'] }}%)</td>
                            <td class="table-danger">{{ $group['needingRecount'] }} ({{ $group['needingRecountPercentage'] }}%)</td>
                            <td class="table-success">{{ $group['accepted'] }} ({{ $group['acceptedPercentage'] }}%)</td>
                            <td style="text-align: right;">$ {{ number_format( $group['expectedValue'], 2 ) }}</td>
                            <td style="text-align: right;">$ {{ number_format( $group['valueCounted'], 2) }} </td>
                            <td style="text-align: right;">$ {{ number_format( $group['variance'],2 ) }}</td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td>TOTALS</td>
                        <td class="table-secondary">{{ $groupsTotals['totalItems'] }}</td>
                        <td class="table-warning">
                            {{ $groupsTotals['totalNotCounted'] }} ({{ number_format( ($groupsTotals['totalNotCounted'] / $groupsTotals['totalItems'])) * 100 }}%)
                        </td>
                        <td class="table-danger">
                            {{ $groupsTotals['totalNeedingRecount'] }} ({{ number_format( ($groupsTotals['totalNeedingRecount'] / $groupsTotals['totalItems'])) * 100 }}%)
                        </td>

                        <td class="table-success">
                            {{ $groupsTotals['totalAccepted'] }} ({{ number_format( ($groupsTotals['totalAccepted'] / $groupsTotals['totalItems'])) * 100 }}%)

                        </td>
                        <td style="text-align: right;">$ {{ number_format($groupsTotals['totalValue'], 2) }}</td>

                        <td style="text-align: right;">$ {{ number_format( $groupsTotals['totalValueCounted'], 2) }}</td>
                        <td style="text-align: right;">$ {{ number_format($groupsTotals['totalVariance'], 2) }}
                            @if ( $groupsTotals['totalValue'] )
                            ({{ number_format( ($groupsTotals['totalValueCounted'] / $groupsTotals['totalValue'])) * 100 }}%)
                                @endif
                        </td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>






    <h2>Progress By Warehouse</h2>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Warehouse</th>
                    <th class="table-secondary">Total Items</th>
                    <th class="table-warning">Not Yet Counted</th>
                    <th class="table-danger">Needing Recount</th>
                    <th class="table-success">Accepted</th>
                    <th style="text-align: right;">Total Expected Value</th>
                    <th style="text-align: right;" class="">Value Counted</th>
                    <th style="text-align: right;">Variance</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $warehouses as $warehouse)
                    <tr>
                        <td>{{ $warehouse['name'] }}</td>
                        <td class="table-secondary">{{ $warehouse['totalItems'] }}</td>
                        <td class="table-warning">{{ $warehouse['notCounted'] }} ({{ $warehouse['notCountedPercentage'] }}%)</td>
                        <td class="table-danger">{{ $warehouse['needingRecount'] }} ({{ $warehouse['needingRecountPercentage'] }}%)</td>
                        <td class="table-success">{{ $warehouse['accepted'] }} ({{ $warehouse['acceptedPercentage'] }}%)</td>
                        <td style="text-align: right;">$ {{ number_format( $warehouse['expectedValue'],2 ) }}</td>
                        <td style="text-align: right;">$ {{ number_format( $warehouse['valueCounted'],2 ) }} </td>
                        <td style="text-align: right;">$ {{ number_format( $warehouse['variance'],2 ) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>TOTALS</td>
                    <td class="table-secondary">{{ $warehousesTotals['totalItems'] }}</td>
                    <td class="table-warning">
                        {{ $warehousesTotals['totalNotCounted'] }} ({{ number_format( ($warehousesTotals['totalNotCounted'] / $warehousesTotals['totalItems'])) * 100 }}%)
                    </td>
                    <td class="table-danger">
                        {{ $warehousesTotals['totalNeedingRecount'] }} ({{ number_format( ($warehousesTotals['totalNeedingRecount'] / $warehousesTotals['totalItems'])) * 100 }}%)
                    </td>

                    <td class="table-success">
                        {{ $warehousesTotals['totalAccepted'] }} ({{ number_format( ($warehousesTotals['totalAccepted'] / $warehousesTotals['totalItems'])) * 100 }}%)

                    </td>
                    <td style="text-align: right;">$ {{ number_format($warehousesTotals['totalValue'], 2) }}</td>

                    <td style="text-align: right;">$ {{ number_format( $warehousesTotals['totalValueCounted'], 2) }}</td>
                    <td style="text-align: right;">$ {{ number_format($warehousesTotals['totalVariance'], 2) }}
                        @if ( $warehousesTotals['totalValue'])
                        ({{ number_format( ($warehousesTotals['totalValueCounted'] / $warehousesTotals['totalValue'])) * 100 }}%)
                        @endif
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>





    <h2>Progress By Locale</h2>

    <div class="row">
        <div class="col-md-12">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>locale</th>
                    <th class="table-secondary">Total Items</th>
                    <th class="table-warning">Not Yet Counted</th>
                    <th class="table-danger">Needing Recount</th>
                    <th class="table-success">Accepted</th>
                    <th style="text-align: right; ">Total Expected Value</th>
                    <th style="text-align: right;" class="">Value Counted</th>
                    <th style="text-align: right;">Variance</th>

                </tr>
                </thead>
                <tbody>
                @foreach( $locales as $locale)
                    <tr>
                        <td>{{ $locale['name'] }}</td>
                        <td class="table-secondary">{{ $locale['totalItems'] }}</td>
                        <td class="table-warning">{{ $locale['notCounted'] }} ({{ $locale['notCountedPercentage'] }}%)</td>
                        <td class="table-danger">{{ $locale['needingRecount'] }} ({{ $locale['needingRecountPercentage'] }}%)</td>
                        <td class="table-success">{{ $locale['accepted'] }} ({{ $locale['acceptedPercentage'] }}%)</td>
                        <td style="text-align: right;">$ {{ number_format( $locale['expectedValue'], 2 ) }}</td>
                        <td style="text-align: right;">$ {{ number_format( $locale['valueCounted'], 2) }} </td>
                        <td style="text-align: right;">$ {{number_format( $locale['variance'],2 ) }}</td>
                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                    <td>TOTALS</td>
                    <td class="table-secondary">{{ $localesTotals['totalItems'] }}</td>
                    <td class="table-warning">
                        {{ $localesTotals['totalNotCounted'] }} ({{ number_format( ($localesTotals['totalNotCounted'] / $localesTotals['totalItems'])) * 100 }}%)
                    </td>
                    <td class="table-danger">
                        {{ $localesTotals['totalNeedingRecount'] }} ({{ number_format( ($localesTotals['totalNeedingRecount'] / $localesTotals['totalItems'])) * 100 }}%)
                    </td>

                    <td class="table-success">
                        {{ $localesTotals['totalAccepted'] }} ({{ number_format( ($localesTotals['totalAccepted'] / $localesTotals['totalItems'])) * 100 }}%)

                    </td>
                    <td style="text-align: right;">$ {{ number_format($localesTotals['totalValue'],2 ) }}</td>

                    <td style="text-align: right;">$ {{ number_format( $localesTotals['totalValueCounted'], 2 ) }}</td>
                    <td style="text-align: right;">$ {{ number_format($localesTotals['totalVariance'], 2) }}
                        @if ( $localesTotals['totalValue'] )
                        ({{ number_format( ($localesTotals['totalValueCounted'] / $localesTotals['totalValue'])) * 100 }}%)
                        @endif
                    </td>
                </tr>
                </tfoot>
            </table>
        </div>
    </div>




    <a href="{{ url('syspro/inventory/'.$inventory->id) }}"
       class="btn btn-dark btn-lg">Back to the Count</a>
@endsection
