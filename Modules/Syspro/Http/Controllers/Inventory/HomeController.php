<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    /**
     * @param Inventory $inventory
     * @return View
     */
    public function home(Inventory $inventory ): View
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
            $notCountedPercentage = number_format( ( $notCounted / $totalItems ) * 100);

            $needingRecount =  $row->where('line_status','Needs Recount')->count();
            $groupsTotals['totalNeedingRecount'] += $needingRecount;
            $needingRecountPercentage = number_format( ( $needingRecount / $totalItems ) * 100);

            $accepted =  $row->whereIn('line_status',['Accepted','Matched'])->count();
            $groupsTotals['totalAccepted'] += $accepted;
            $acceptedPercentage = number_format( ( $accepted / $totalItems ) * 1000);


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








        return view('syspro::InventoryCounts.counts.home', [
            'inventory' => $inventory,
            'total' => $inventory->items->count(),
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

            'totalValueExpected' => DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('expected_value'),
            'totalValueCounted' => DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('counted_value'),
        ]);
    }


}
