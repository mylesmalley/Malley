<?php

namespace Modules\Syspro\Http\Controllers\InventoryItems;

use App\Http\Controllers\Controller;
use App\Models\Inventory;
use App\Models\InventoryItem;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;

class SearchController extends Controller
{

    /**
     * @param int $inventory_id
     * @param string $area
     * @param string $term
     * @param string $filter
     * @return LengthAwarePaginator
     */
    private function results( int $inventory_id, string $area, string $term, string $filter ): LengthAwarePaginator
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->where('inventory_id', $inventory_id )
            ->where($area,'like', '%'.strtoupper( $term ).'%');

        if ( $filter != 'All' )
        {
            $db->where( "line_status", $filter);

        }

            $db->orderBy('group')
                ->orderBy('bin')
                ->orderBy('stock_code');

        return $db->paginate(25);
    }


    /**
     * @param int $inventory_id
     * @param string $area
     * @param string $term
     * @param string $filter
     * @return Collection
     */
    private function ids( int $inventory_id, string $area, string $term, string $filter ): Collection
    {
        $db = DB::table('Inventory_Latest_Counts')
            ->select('id')
            ->where('inventory_id', $inventory_id )
           ->where( $area,'like', '%'.strtoupper ($term ).'%');
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
     * @param string $area
     * @param string $term
     * @param string $filter
     * @return Response
     */
    public function search( Inventory $inventory, string $area, string $term, string $filter = 'All' ): Response
    {
        $db = $this->results($inventory->id, $area, $term, $filter);
        $idsForTickets = $this->ids($inventory->id, $area, $term, $filter);

        return response()
            ->view('syspro::InventoryCounts.counts.search.stock_code', [
            'inventory' => $inventory,
            'term' => $term,
            'title' => "$filter from $area $term",
            'items' =>$db,
            'area' => $area,
            'idsForTickets' => $idsForTickets,
        ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function searchWithPost( Request $request ): RedirectResponse
    {
        $request->validate([
            'inventory_id' => 'required|int',
            'area' => 'required|string',
            'term' => 'required|string',
            'filter' => 'nullable|string',
        ]);

        if ( $request->input('area') === 'ticket_number')
        {
            $ticket = InventoryItem::where( 'ticket_number', '=', $request->input('term') )
                ->where('inventory_id', '=', $request->input('inventory_id'))
                ->firstOrFail();
            return redirect("syspro/inventory/".$request->input('inventory_id')."/items/". $ticket->id );

        }

        $term = trim($request->input('term'));

        return redirect("syspro/inventory/".$request->input('inventory_id')."/search/".$request->input('area')."/for/$term/".$request->input('filter') );

    }

}


