<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;

class FilteredReportController extends Controller
{

    private $filters = [
        'group',
        'bin',
    ];


    public function show( Inventory $inventory, Request $request )
    {

        $db = DB::table('Inventory_Latest_Counts')
                ->where('inventory_id', $inventory->id);

        if (isset($request->filter)
            && isset($request->by)
            && in_array($request->filter, $this->filters )) {

            $db->where($request->filter, $request->by);
        }

        $items = $db->pluck('id');


        return view('syspro::InventoryCounts.counts.filteredItemsList', [
            'inventory' => $inventory,
            'items' => InventoryItem::whereIn('id', $items)->paginate(25),
            'filter' => $request->filter,
            'by' => $request->by,
        ]);
    }

}
