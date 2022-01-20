<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CreateController extends Controller
{
    /**
     * @param Inventory $inventory
     * @return Response
     */
    public function create(Inventory $inventory ): Response
    {
        return response()->view('syspro::InventoryCounts.counts.items.create', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
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
