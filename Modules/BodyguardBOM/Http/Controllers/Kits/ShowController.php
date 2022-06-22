<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

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

        return response()->view('bodyguardbom::kits.show', [
            'kit' => $kit,
            'components' => DB::connection('syspro')
                ->table('BomStructure')
                ->select(['BomStructure.Component', 'BomStructure.QtyPer', 'InvMaster.Description', 'InvMaster.StockUom' ])
                ->leftJoin('InvMaster', 'BomStructure.Component', '=', "InvMaster.StockCode")
                ->where('ParentPart', $kit->part_number )
                ->get(),
        ]);
    }


}


