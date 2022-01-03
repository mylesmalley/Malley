<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\InventoryItemCount;
use App\Models\Inventory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ShowController extends Controller
{

    /**
     * @param Inventory $inventory
     * @param InventoryItem $item
     * @return Response
     */
    public function show(Inventory $inventory, InventoryItem $item): Response
    {
        return response()->view('syspro::InventoryCounts.counts.items.show', [
            'inventory' => $inventory,
            'latest' => DB::table('Inventory_Latest_Counts')
                ->find($item->id),
            'item' => $item,
        ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function acceptCount(Request $request): RedirectResponse
    {
        $request->validate(['count_id'=>'required|int']);
        $count = InventoryItemCount::find( $request->input('count_id') );
        $count->accepted = true;
        $count->save();

        return redirect()->back();
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function markAsRecounted(Request $request): RedirectResponse
    {
        $request->validate(['count_id'=>'required|int']);
        $count = InventoryItemCount::find( $request->input('count_id') );
        $count->recounted = true;
        $count->save();

        return redirect()
            ->back();
    }



}
