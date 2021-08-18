<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\InventoryItem;
use App\Models\Inventory;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use \Illuminate\Contracts\Pagination\LengthAwarePaginator;
use \Illuminate\Support\Collection;
use \Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * @param int $inventory_id
     * @param string $filter
     * @param string $term
     * @return
     */
    private function results( int $inventory_id, string $area, string $term, string $filter ): LengthAwarePaginator
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory_id )
            ->where($area,'like', '%'.strtoupper( $term ).'%');
   //     ->whereRaw("? collate SQL_Latin1_General_CP1_CI_AS LIKE  '%?%'", [$area, $term]);

        if ( $filter != 'All' )
        {
            $db->where( "line_status", $filter);

        }

            $db->orderBy('group')
                ->orderBy('bin')
                ->orderBy('stock_code');

      //  dd( $db->toSql());

        return $db->paginate(25);
    }


    /**
     * @param int $inventory_id
     * @param string $filter
     * @param string $term
     * @return Collection
     */
    private function ids( int $inventory_id, string $area, string $term, string $filter ): Collection
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->select('id')
            ->where('inventory_id', $inventory_id )
           ->where( $area,'like', '%'.strtoupper ($term ).'%');
//            ->whereRaw('? collate SQL_Latin1_General_CP1_CI_AS LIKE  ?', [$area, "%".$term."%"]);

        if ( $filter  != 'All' )
        {
            $db->where( "line_status", $filter);

        }
        $db->orderBy('group')
            ->orderBy('bin')
            ->orderBy('stock_code');
            return $db->pluck('id');

    }

    /**
     * @param Inventory $inventory
     * @param string $filter
     * @param string $term
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|View
     */
    public function search( Inventory $inventory, string $area, string $term, string $filter = 'All' )
    {
//        dd( $area, $term, $filter);

        $db = $this->results($inventory->id, $area, $term, $filter);
        $idsForTickets = $this->ids($inventory->id, $area, $term, $filter);

        return view('syspro::InventoryCounts.counts.search.stock_code', [
            'inventory' => $inventory,
            'term' => $term,
            'title' => "{$filter} from {$area} {$term}",
            'items' =>$db,
            'area' => $area,
            'idsForTickets' => $idsForTickets,
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function searchWithPost( Request $request )
    {
        $request->validate([
            'inventory_id' => 'required|int',
            'area' => 'required|string',
            'term' => 'required|string',
            'filter' => 'nullable|string',
        ]);

        $request->term = trim($request->term);

        return redirect("syspro/inventory/{$request->inventory_id}/search/{$request->area}/for/{$request->term}/{$request->filter}");

    }

}


