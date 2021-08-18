<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\InventoryItemCount;
use App\Models\Inventory;
use \Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{

    /**
     * @param Inventory $inventory
     * @param InventoryItem $item
     * @return View
     */
    public function show(Inventory $inventory, InventoryItem $item): View
    {
        return view('syspro::InventoryCounts.counts.items.show', [
            'inventory' => $inventory,
            'latest' => $db = DB::table('Inventory_Latest_Counts')
                ->find($item->id),
            'item' => $item,
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function acceptCount(Request $request)
    {
        $request->validate(['count_id'=>'required|int']);
        $count = InventoryItemCount::find( $request->count_id );
        $count->accepted = true;
        $count->save();

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function markAsRecounted(Request $request)
    {
        $request->validate(['count_id'=>'required|int']);
        $count = InventoryItemCount::find( $request->count_id );
        $count->recounted = true;
        $count->save();

        return redirect()->back();
    }



}
