<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class ProgressReportController extends Controller
{


    /**
     * @param Inventory $count
     * @return Response
     */
    public function show(Inventory $inventory ): Response
    {

        $groups = [];
        $groupsTotals = [
            'totalItems' => 0,
            'totalValue' => 0,
            'totalNotCounted' => 0,
            'totalNeedingRecount' => 0,
            'totalAccepted' => 0,
            'totalValueCounted' => 0,
            'totalVariance' => 0,
        ];

        $groupNames = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->select('group')
            ->groupBy('group')
            ->orderBy('group')
            ->pluck('group');


        foreach( $groupNames as $name )
        {
            $row = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('group', $name )
                ->get();

            $totalItems = $row->count();
            $expectedValue = $row->sum('expected_value');


            $groupsTotals['totalItems'] += $totalItems;
            $groupsTotals['totalValue'] += $expectedValue;

            $notCounted =  $row->where('line_status','Not Counted')->count();
            $groupsTotals['totalNotCounted'] += $notCounted;
            $notCountedPercentage = number_format( ( $notCounted / $totalItems ) * 100, 0);

            $needingRecount =  $row->where('line_status','Needs Recount')->count();
            $groupsTotals['totalNeedingRecount'] += $needingRecount;
            $needingRecountPercentage = number_format( ( $needingRecount / $totalItems ) * 100, 0);

            $accepted =  $row->whereIn('line_status',['Accepted','Matched','Recounted'])->count();
            $groupsTotals['totalAccepted'] += $accepted;
            $acceptedPercentage = number_format( ( $accepted / $totalItems ) * 100, 0);


            $valueCounted = $row->sum('counted_value');
            $variance = $expectedValue - $valueCounted;

            $groupsTotals['totalValueCounted'] += $valueCounted;
            $groupsTotals['totalVariance'] += $variance;


            $groups[] = [
                'name' => $name,
                'totalItems' => $totalItems,
                'expectedValue' => $expectedValue,
                'countedValue' => $row->sum('counted_value'),
                'notCounted' => $notCounted,
                'notCountedPercentage' => $notCountedPercentage,
                'needingRecount' => $needingRecount,
                'needingRecountPercentage' => $needingRecountPercentage,
                'accepted' => $accepted,
                'acceptedPercentage' => $acceptedPercentage,
                'valueCounted' => $valueCounted,
                'variance' => $variance,
            ];
        }












        $warehouses = [];
        $warehousesTotals = [
            'totalItems' => 0,
            'totalValue' => 0,
            'totalNotCounted' => 0,
            'totalNeedingRecount' => 0,
            'totalAccepted' => 0,
            'totalValueCounted' => 0,
            'totalVariance' => 0,
        ];

        $warehouseNames = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->select('warehouse')
            ->groupBy('warehouse')
            ->pluck('warehouse');


        foreach( $warehouseNames as $name )
        {
            $row = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('warehouse', $name )
                ->get();

            $totalItems = $row->count();
            $expectedValue = $row->sum('expected_value');


            $warehousesTotals['totalItems'] += $totalItems;
            $warehousesTotals['totalValue'] += $expectedValue;

            $notCounted =  $row->where('line_status','Not Counted')->count();
            $warehousesTotals['totalNotCounted'] += $notCounted;
            $notCountedPercentage = number_format( ( $notCounted / $totalItems ) * 100, 0);

            $needingRecount =  $row->where('line_status','Needs Recount')->count();
            $warehousesTotals['totalNeedingRecount'] += $needingRecount;
            $needingRecountPercentage = number_format( ( $needingRecount / $totalItems ) * 100, 0);

            $accepted =  $row->whereIn('line_status',['Accepted','Matched','Recounted'])->count();
            $warehousesTotals['totalAccepted'] += $accepted;
            $acceptedPercentage = number_format( ( $accepted / $totalItems ) * 100, 0);


            $valueCounted = $row->sum('counted_value');
            $variance = $expectedValue - $valueCounted;

            $warehousesTotals['totalValueCounted'] += $valueCounted;
            $warehousesTotals['totalVariance'] += $variance;


            $warehouses[] = [
                'name' => $name,
                'totalItems' => $totalItems,
                'expectedValue' => $expectedValue,
                'countedValue' => $row->sum('counted_value'),
                'notCounted' => $notCounted,
                'notCountedPercentage' => $notCountedPercentage,
                'needingRecount' => $needingRecount,
                'needingRecountPercentage' => $needingRecountPercentage,
                'accepted' => $accepted,
                'acceptedPercentage' => $acceptedPercentage,
                'valueCounted' => $valueCounted,
                'variance' => $variance,
            ];
        }







        $locales = [];
        $localesTotals = [
            'totalItems' => 0,
            'totalValue' => 0,
            'totalNotCounted' => 0,
            'totalNeedingRecount' => 0,
            'totalAccepted' => 0,
            'totalValueCounted' => 0,
            'totalVariance' => 0,
        ];

        $localeNames = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->select('locale')
            ->groupBy('locale')
            ->pluck('locale');


        foreach( $localeNames as $name )
        {
            $row = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('locale', $name )
                ->get();

            $totalItems = $row->count();
            $expectedValue = $row->sum('expected_value');


            $localesTotals['totalItems'] += $totalItems;
            $localesTotals['totalValue'] += $expectedValue;

            $notCounted =  $row->where('line_status','Not Counted')->count();
            $localesTotals['totalNotCounted'] += $notCounted;
            $notCountedPercentage = number_format( ( $notCounted / $totalItems ) * 100, 0);

            $needingRecount =  $row->where('line_status','Needs Recount')->count();
            $localesTotals['totalNeedingRecount'] += $needingRecount;
            $needingRecountPercentage = number_format( ( $needingRecount / $totalItems ) * 100, 0);

            $accepted =  $row->whereIn('line_status',['Accepted','Matched','Recounted'])->count();
            $localesTotals['totalAccepted'] += $accepted;
            $acceptedPercentage = number_format( ( $accepted / $totalItems ) * 100, 0);


            $valueCounted = $row->sum('counted_value');
            $variance = $expectedValue - $valueCounted;

            $localesTotals['totalValueCounted'] += $valueCounted;
            $localesTotals['totalVariance'] += $variance;


            $locales[] = [
                'name' => $name,
                'totalItems' => $totalItems,
                'expectedValue' => $expectedValue,
                'countedValue' => $row->sum('counted_value'),
                'notCounted' => $notCounted,
                'notCountedPercentage' => $notCountedPercentage,
                'needingRecount' => $needingRecount,
                'needingRecountPercentage' => $needingRecountPercentage,
                'accepted' => $accepted,
                'acceptedPercentage' => $acceptedPercentage,
                'valueCounted' => $valueCounted,
                'variance' => $variance,
            ];
        }













        return response()
            ->view('syspro::InventoryCounts.counts.progressReport', [
            'inventory' => $inventory,
                'total' => DB::table('inventory_items')
                    ->where('inventory_id', '=', $inventory->id)
                    ->count(),

                'neverCounted' => DB::table('Inventory_Latest_Counts')
                                ->where('inventory_id', $inventory->id)
                ->where('line_status','Not Counted')
                                ->count(),
            //'needsRecount'  => 4,
              'needsRecount' => DB::table('Inventory_Latest_Counts')
                                ->where('inventory_id', $inventory->id)
                                ->where('line_status','Needs Recount')
                                ->count(),
            'bins' => DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->select('bin')
                ->groupBy('bin')
                ->get(),
            'groups' => $groups,
            'groupsTotals' => $groupsTotals,
            'locales' => $locales,
            'localesTotals' => $localesTotals,
            'warehouses' => $warehouses,
            'warehousesTotals' => $warehousesTotals,
            'totalValueExpected' => DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('expected_value'),
            'totalValueCounted' => DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('counted_value'),
        ]);
    }


}
