<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Modules\BodyguardBOM\Models\Kit;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ShowController extends Controller
{

    /**
     * @param Kit $kit
     * @return Response
     */
    public function show( Kit $kit ) : Response
    {
//        $kit->load('categories');


        $where_used_parents = DB::table('bg_syspro_components')
            ->where('stock_code', '=', $kit->part_number)
            ->pluck('bg_kit_id');

        $where_used = Kit::whereIn('id', $where_used_parents)
            ->get();


        return response()->view('bodyguardbom::kits.show', [
            'kit' => $kit,
            'syspro_components' => DB::connection('syspro')
                ->table('BomStructure')
                ->select(['BomStructure.Component', 'BomStructure.QtyPer', 'InvMaster.Description', 'InvMaster.StockUom' ])
                ->leftJoin('InvMaster', 'BomStructure.Component', '=', "InvMaster.StockCode")
                ->where('ParentPart', $kit->part_number )
                ->get(),
            'where_used' => $where_used,
        ]);
    }


    /**
     * @param string $stock_code
     * @return RedirectResponse
     */
    public function show_by_part_number( string $stock_code ): RedirectResponse
    {
        $kit = Kit::where( 'part_number', '=', $stock_code )->first();

        if ( $kit )
        {
            return redirect()->route('bg.kits.show', $kit );
        }

        return redirect()->route('bg.kits.home');
    }

}


