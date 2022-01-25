<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class CreateController extends Controller
{
    /**
     * @param Inventory $inventory
     * @return Response
     */
    public function create(Inventory $inventory ): Response
    {
        return response()
            ->view('syspro::InventoryCounts.counts.items.create', [
            'inventory' => $inventory,
        ]);
    }

    /**
     * @param Inventory $inventory
     * @param Request $request
     * @return RedirectResponse
     */
    public function store(Inventory $inventory, Request $request): RedirectResponse
    {
        $request->validate([
            'stock_code' => 'required|string|max:30',
            'description_1' => 'required|string|max:100',
            'description_2' => 'nullable|string|max:100',
            'expected_quantity' => "int|min:0",
//            'inventory_id' => 'required|int',
            'unit_of_measure' => 'required|string|max:20',
            'bin' => 'required|string|max:20',
            'warehouse' => 'nullable|string|max:20',
            'locale' => 'nullable|max:20',
            'group' => 'required|string|max:20',
        ]);


        $syspro = DB::connection('syspro')
            ->table('Inventory_Create_Count_List')
            ->select('StockCode','UnitCost', 'desc1', 'desc2', 'StockUom')
             ->where('StockCode', '=', $request->input('stock_code'))
             ->first();


        $item = InventoryItem::create(
            $request->only([
                'stock_code',
                'description_1',
                'description_2',
                'expected_quantity',
                'unit_of_measure',
                'bin',
                'group',
                'locale',
                'warehouse',
            ]));


        if ( $syspro )
        {
            $item->cost = $syspro->UnitCost;
            $item->description_1 = trim( $syspro->desc1);
            $item->unit_of_measure = trim( strtoupper( $syspro->StockUom ) ) ?? "EA";
            $item->description_2 = trim( $syspro->desc2);

        }

        $item->inventory_id = $inventory->id;
        $item->manually_added = 1;
        $item->save();
         return redirect()->route('inventory_count.show_item', [$inventory, $item ]);

       // return redirect('syspro/inventory/'.$request->inventory_id.'/search/group/for/'.$request->group);
    }

}
