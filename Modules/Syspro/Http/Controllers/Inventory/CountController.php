<?php

namespace Modules\Syspro\Http\Controllers\Inventory;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Syspro\Jobs\CacheNextPreviousItem;

class CountController extends Controller
{
    /**
     * @return Response
     */
    public function index(): Response
    {
        return response()->view('syspro::InventoryCounts.home', [
            'counts' => Inventory::orderBy('created_at','DESC')
            ->get(),
        ]);
    }


    /**
     * @param Inventory $inventory
     */
    public function update_caches( Inventory $inventory ): void
    {

        $ids = DB::table('inventory_items')
            ->where('inventory_id', '=', $inventory->id )
            ->pluck('id');

        echo "updating cache for ".count($ids)." records";

        foreach( $ids as $id )
        {
            CacheNextPreviousItem::dispatch( $id );
        }

        Log::info("Finished Updating Caches");

    }


}
