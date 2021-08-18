<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class ShowAllController extends Controller
{
    public function showAll(Inventory $inventory ): View
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->get();

        return view('syspro::InventoryCounts.counts.search.all', [
            'inventory' => $inventory,
            'title' => "All Items",
            'items' =>$db,
        ]);

    }

    public function showAllPaginated(Inventory $inventory ): View
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->paginate(50);

        return view('syspro::InventoryCounts.counts.search.all', [
            'inventory' => $inventory,
            'title' => "All Items, paginated",
            'items' =>$db,
        ]);

    }

    public function showNeedsRecount(Inventory $inventory ): View
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->where('line_status', 'Needs Recount')
            ->get();

        return view('syspro::InventoryCounts.counts.search.all', [
            'inventory' => $inventory,
            'title' => "All Requiring Recount",
            'items' =>$db,
        ]);

    }

    public function sshowNeedsRecountPaginated(Inventory $inventory ): View
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory->id)
            ->where('line_status', 'Needs Recount')
            ->paginate(50);

        return view('syspro::InventoryCounts.counts.search.all', [
            'inventory' => $inventory,
            'title' => "All Requiring Recount, Paginated",
            'items' =>$db,
        ]);

    }

}
