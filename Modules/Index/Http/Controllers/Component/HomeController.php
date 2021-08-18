<?php

namespace Modules\Index\Http\Controllers\Component;

use App\Models\Option;
use App\Http\Controllers\Controller;
use \Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @param Option $option
     * @return View
     */
    public function home( Option $option ) : View
    {
        return view('index::options.components.home', [
            'syspro' => DB::connection('syspro')
                ->table('BomStructure')
                ->select(['BomStructure.Component', 'BomStructure.QtyPer', 'InvMaster.Description', 'InvMaster.StockUom' ])
                ->leftJoin('InvMaster', 'BomStructure.Component', '=', "InvMaster.StockCode")
                ->where('ParentPart', $option->option_syspro_phantom)
                ->get(),
            'option' => $option,
            'components' => $option->components()->get()
        ]);
    }



}
