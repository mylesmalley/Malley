<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{


    /**
     * @param Inventory $inventory
     * @return Response
     */
    public function home(Inventory $inventory ): Response
    {



        if ( Cache::has('inventory_'.$inventory->id.'_groups'))
        {
            $groups = Cache::get('inventory_'.$inventory->id.'_groups');
        }
        else
        {
            $groups = [];
        }



        if ( Cache::has('inventory_'.$inventory->id.'_groupNames'))
        {
            $groupNames = Cache::get('inventory_'.$inventory->id.'_groupNames');
        }
        else
        {
            $groupNames = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->select('group')
                ->groupBy('group')
                ->orderBy('group')
                ->pluck('group');

            Cache::put('inventory_'.$inventory->id.'_groupNames' , $groupNames, 600 );
        }




        if ( Cache::has('inventory_'.$inventory->id.'_groupTotals'))
        {
            $groupsTotals = Cache::get('inventory_'.$inventory->id.'_groupTotals');
        }
        else
        {
            $groupsTotals = [
                'totalItems' => 0,
                'totalValue' => 0,
                'totalNotCounted' => 0,
                'totalNeedingRecount' => 0,
                'totalAccepted' => 0,
                'totalValueCounted' => 0,
                'totalVariance' => 0,
            ];

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

            Cache::put('inventory_'.$inventory->id.'_groups' , $groups, 600 );
            Cache::put('inventory_'.$inventory->id.'_groupTotals' , $groupsTotals, 600 );
        }



        /*
         * Never Counted
         */
        if ( Cache::has('inventory_'.$inventory->id.'_neverCounted'))
        {
            $neverCounted = Cache::get('inventory_'.$inventory->id.'_neverCounted');
        }
        else
        {
            $neverCounted = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('line_status','Not Counted')
                ->count();

            Cache::put('inventory_'.$inventory->id.'_neverCounted' , $neverCounted, 600 );
        }


        /*
         * Needs Recount
         */
        if ( Cache::has('inventory_'.$inventory->id.'_needsRecount'))
        {
            $needsRecount = Cache::get('inventory_'.$inventory->id.'_needsRecount');
        }
        else
        {
            $needsRecount = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('line_status','Needs Recount')
                ->count();

            Cache::put('inventory_'.$inventory->id.'_needsRecount' , $needsRecount, 600 );
        }


        /*
         * Bins
         */
        if ( Cache::has('inventory_'.$inventory->id.'_bins'))
        {
            $bins = Cache::get('inventory_'.$inventory->id.'_bins');
        }
        else
        {
            $bins = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->select('bin')
                ->groupBy('bin')
                ->get();

            Cache::put('inventory_'.$inventory->id.'_bins' , $bins, 600 );
        }




        if ( Cache::has('inventory_'.$inventory->id.'_totalValueExpected'))
        {
            $totalValueExpected = Cache::get('inventory_'.$inventory->id.'_totalValueExpected');
        }
        else
        {
            $totalValueExpected = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('expected_value');

            Cache::put('inventory_'.$inventory->id.'_totalValueExpected' , $totalValueExpected, 600 );
        }

        if ( Cache::has('inventory_'.$inventory->id.'_totalValueCounted'))
        {
            $totalValueCounted = Cache::get('inventory_'.$inventory->id.'_totalValueCounted');
        }
        else
        {
            $totalValueCounted = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('counted_value');

            Cache::put('inventory_'.$inventory->id.'_totalValueCounted' , $totalValueCounted, 600 );
        }







        return response()->view('syspro::InventoryCounts.counts.home', [
            'inventory' => $inventory,
            'total' => DB::table('inventory_items')
                ->where('inventory_id', '=', $inventory->id)
                ->count(),
            'neverCounted' => $neverCounted,
            'needsRecount' => $needsRecount,
            'bins' => $bins,
            'groups' => $groups,
            'groupsTotals' => $groupsTotals,
            'totalValueExpected' => $totalValueExpected,
            'totalValueCounted' => $totalValueCounted,
        ]);
    }


}
