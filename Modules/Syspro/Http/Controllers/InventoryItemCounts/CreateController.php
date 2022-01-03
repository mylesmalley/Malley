<?php

namespace Modules\Syspro\Http\Controllers\InventoryItemCounts;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use App\Models\InventoryItemCount;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Syspro\Jobs\CacheNextPreviousItem;


class CreateController extends Controller
{
//    /**
//     * @param Inventory $inventory
//     * @param InventoryItem $inventoryItem
//     * @return Response
//     */
//    public function create( Inventory $inventory, InventoryItem $inventoryItem ): Response
//    {
//        return response()->view('syspro::InventoryCounts.counts.takeCountForm', [
//            'inventory' => $inventory,
//            'inventoryItem' =>$inventoryItem,
//        ]);
//    }

    /**
     * @param Request $request
     * @param Inventory $inventory
     * @param InventoryItem $inventoryItem
     * @return RedirectResponse
     */
    public function store( Request $request, Inventory $inventory, InventoryItem $inventoryItem ): RedirectResponse
    {
        $request->validate([
            'counted' => 'required|numeric',
            'counter_name' => 'nullable|string|max:50',
        ]);


        session(['counter_name' => $request->input('counter_name') ] );

        $count = InventoryItemCount::create([
            'inventory_item_id' => $inventoryItem->id,
            'counted' => $request->input('counted'),
            'user_id' => Auth::user()->id ?? null,
            'counter_name' => $request->input('counter_name'),
        ]);

        $count->save();

        // grab related ids and update each.
        $update_ids = [
            $inventoryItem->next_id ?? null,
            $inventoryItem->previous_id ?? null,
            $inventoryItem->next_uncounted_id ?? null,
            $inventoryItem->previous_uncounted_id ?? null,
        ];
        $unique_ids = array_unique( $update_ids );
        $update_ids = array_filter($unique_ids,'strlen');


        foreach( $update_ids as $id )
        {
            CacheNextPreviousItem::dispatch( $id );
        }





        return redirect()
            ->back();
    }
}
