<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VarianceAcceptanceReportController extends Controller
{
    public function show( Inventory $inventory, string $group )
    {
        $results = DB::table('Inventory_Acceptance_Report')
            ->where('inventory_id', $inventory->id)
            ->where("group", $group )
            ->orderBy('bin')
            ->get();

        return view('syspro::InventoryCounts.counts.varianceAcceptanceReport',
            [
                'items'=>$results,
                'inventory' => $inventory,
                'target' => $group,
            ]);

//        dd( $results );
    }

}
