<?php

namespace Modules\Syspro\Http\Controllers\InventoryItemCounts;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use App\Models\InventoryItemCount;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class CreateController extends Controller
{
    public function create( Inventory $inventory, InventoryItem $inventoryItem )
    {
        return view('syspro::InventoryCounts.counts.takeCountForm', [
            'inventory' => $inventory,
            'inventoryItem' =>$inventoryItem,
        ]);
    }

    public function store( Request $request, Inventory $inventory, InventoryItem $inventoryItem )
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

        return redirect()->back();
    }
}
