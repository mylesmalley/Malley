<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Illuminate\Support\Facades\DB;
use Modules\BodyguardBOM\Models\Kit;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ComponentController extends Controller
{

    /**
     * @param Kit $kit
     * @return Response
     */
    public function show( Kit $kit ) : Response
    {

        $local_staged_stock_codes = $kit->components()->get();

        $local_codes = $local_staged_stock_codes->pluck('stock_code');

        $syspro_components = DB::connection('syspro')
            ->table('BomStructure')
            ->select(['BomStructure.Component', 'BomStructure.QtyPer', 'InvMaster.Description', 'InvMaster.StockUom' ])
            ->leftJoin('InvMaster', 'BomStructure.Component', '=', "InvMaster.StockCode")
            ->where('ParentPart', $kit->part_number )
            ->get();

        $syspro_records_for_local_components = DB::connection('syspro')
            ->table('InvMaster')
            ->select(['StockCode', 'Description', 'StockUom' ])
            ->whereIn('StockCode', $local_codes )
            ->get()
            ->keyBy('StockCode')
            ->toArray()
        ;

       // dd($local_staged_stock_codes, $local_codes,  $syspro_records_for_local_components);
        $local_components = [];

        foreach( $local_staged_stock_codes as $stock )
        {

            $local_components[] = [
                'stock_code' =>   $stock->stock_code,
                'description' => $syspro_records_for_local_components[ $stock->stock_code ]->Description,
                'quantity' => $stock->quantity,
                'uom' => $syspro_records_for_local_components[ $stock->stock_code ]->StockUom,
            ];

        }


    //    dd( $local_components );


        return response()->view('bodyguardbom::kits.components', [
            'kit' => $kit,
            'syspro_components' => $syspro_components,
            'local_components' => json_decode( json_encode($local_components) )
        ]);
    }


}


