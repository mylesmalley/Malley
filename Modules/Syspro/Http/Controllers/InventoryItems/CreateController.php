<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use \Illuminate\View\View;
use \Illuminate\Http\Request;

class CreateController extends Controller
{


    /**
     * @param Inventory $count
     * @return View
     */
    public function create(Inventory $inventory ): View
    {
        return view('syspro::InventoryCounts.counts.items.create', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $request->validate([
            'stock_code' => 'required|string|max:30',
            'description_1' => 'required|string|max:100',
            'description_2' => 'nullable|string|max:100',
            'expected_quantity' => "int|min:0",
            'inventory_id' => 'required|int',
            'unit_of_measure' => 'required|string|max:20',
            'bin' => 'nullable|string|max:20',
            'warehouse' => 'nullable|string|max:20',
            'locale' => 'nullable|max:20',
            'group' => 'required|string|max:20',

        ]);

        $item = InventoryItem::create(
            $request->only([
                'stock_code',
                'description_1',
                'description_2',
                'expected_quantity',
                'unit_of_measure',
                'inventory_id',
                'bin',
                'group',
                'locale',
                'warehouse',
            ]));

        $item->manually_added = 1;
        $item ->save();

        return redirect('syspro/inventory/'.$request->inventory_id.'/search/group/for/'.$request->group);
    }

}
