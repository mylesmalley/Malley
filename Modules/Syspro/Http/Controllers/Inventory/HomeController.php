<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
            Log::info("Pulling inventory GROUPS from cache. ");

            $groups = Cache::get('inventory_'.$inventory->id.'_groups');
        }
        else
        {
            $groups = [];
        }



        if ( Cache::has('inventory_'.$inventory->id.'_groupNames'))
        {
            Log::info("Pulling inventory GROUP NAMES from cache. ");

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

            Log::info("Storing inventory GROUP NAMES in cache. ");

            Cache::put('inventory_'.$inventory->id.'_groupNames' , $groupNames, 600 );
        }




        if ( Cache::has('inventory_'.$inventory->id.'_groupTotals'))
        {
            Log::info("Pulling inventory GROUP TOTALS from cache. ");

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
                'totalRecounted' => 0,
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

                $totalRecounted =  $row->where('line_status','Recounted')->count();
                $groupsTotals['totalRecounted'] += $totalRecounted;


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
                    'totalRecounted' => $totalRecounted,

                ];
            }

            Log::info("Storing inventory GROUPS in cache. ");

            Cache::put('inventory_'.$inventory->id.'_groups' , $groups, 600 );
            Log::info("Storing inventory GROUP TOTALSS in cache. ");

            Cache::put('inventory_'.$inventory->id.'_groupTotals' , $groupsTotals, 600 );
        }



        /*
         * Never Counted
         */
        if ( Cache::has('inventory_'.$inventory->id.'_neverCounted'))
        {
            Log::info("Pulling inventory items never counted from cache. ");

            $neverCounted = Cache::get('inventory_'.$inventory->id.'_neverCounted');
        }
        else
        {
            $neverCounted = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('line_status','Not Counted')
                ->count();
            Log::info("Updating inventory items never counted in cache. ");

            Cache::put('inventory_'.$inventory->id.'_neverCounted' , $neverCounted, 600 );
        }


         /*
         * Needs Recount
         */
        if ( Cache::has('inventory_'.$inventory->id.'_needsRecount'))
        {
            Log::info("Pulling inventory items needing recount from cache. ");

            $needsRecount = Cache::get('inventory_'.$inventory->id.'_needsRecount');
        }
        else
        {
            $needsRecount = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->where('line_status','Needs Recount')
                ->count();

            Log::info("Updating inventory items needing recount in cache. ");

            Cache::put('inventory_'.$inventory->id.'_needsRecount' , $needsRecount, 600 );
        }


        /*
         * Bins
         */
        if ( Cache::has('inventory_'.$inventory->id.'_bins'))
        {
            Log::info("Pulling inventory BINS from cache. ");

            $bins = Cache::get('inventory_'.$inventory->id.'_bins');
        }
        else
        {
            $bins = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->select('bin')
                ->groupBy('bin')
                ->get();

            Log::info("Updating inventory BINS in cache. ");

            Cache::put('inventory_'.$inventory->id.'_bins' , $bins, 600 );
        }




        if ( Cache::has('inventory_'.$inventory->id.'_totalValueExpected'))
        {
            Log::info("Pulling inventory TOTAL VALUE EXPECTED from cache. ");

            $totalValueExpected = Cache::get('inventory_'.$inventory->id.'_totalValueExpected');
        }
        else
        {
            $totalValueExpected = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('expected_value');

            Log::info("Updating inventory TOTAL VALUE EXPECTED in cache. ");

            Cache::put('inventory_'.$inventory->id.'_totalValueExpected' , $totalValueExpected, 600 );
        }



//        if ( Cache::has('inventory_'.$inventory->id.'_totalMatched'))
//        {
//            Log::info("Pulling inventory number matched. ");
//
//            $totalMatched = Cache::get('inventory_'.$inventory->id.'_totalMatched');
//        }
//        else
//        {
//            $totalMatched = DB::table('Inventory_Latest_Counts')
//                ->where('inventory_id', $inventory->id)
//                ->where('line_status','Matched')
//                ->count();
//
//            Log::info("Updating inventory TOTAL MATCHED in cache. ");
//
//            Cache::put('inventory_'.$inventory->id.'_totalMatched' , $totalMatched, 600 );
//        }




        if ( Cache::has('inventory_'.$inventory->id.'_totalValueCounted'))
        {
            Log::info("Pulling inventory TOTAL VALUE COUNTED from cache. ");

            $totalValueCounted = Cache::get('inventory_'.$inventory->id.'_totalValueCounted');
        }
        else
        {
            $totalValueCounted = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id)
                ->sum('counted_value');

            Log::info("Updating inventory TOTAL VALUE COUNTED in cache. ");

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
//            'totalMatched' => $totalMatched,


        ]);
    }


}
