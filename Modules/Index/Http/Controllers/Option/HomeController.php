<?php

namespace Modules\Index\Http\Controllers\Option;


use App\Http\Controllers\Controller;
use App\Models\Option;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show( Option $option )
    {
        $option->with([
            'components',
            'templates',
            'user',
            'rules',
            'configurations',
            'formElementItems',
            'formElementItems.formElement',
            'formElementItems.formElement.form',
            'tags'
        ]);

        return view('index::options.home',[
//            'components' => $option->components,
            'components' => DB::connection('syspro')
                ->table('BomStructure')
                ->select(['BomStructure.Component as component_stock_code',
                    'BomStructure.QtyPer as component_material_qty',
                    'InvMaster.Description as component_description',
                    'InvMaster.StockUom as component_unit_of_measure',
                    'InvMaster.PartCategory as component_part_category',
//                    'InvMaster.PartCategory as component_where_built_location',
                    DB::raw( "(BomStructure.QtyPer * InvMaster.MaterialCost ) as totalCost"),
                ])
                ->leftJoin('InvMaster', 'BomStructure.Component', '=', "InvMaster.StockCode")
                ->where('ParentPart', $option->option_syspro_phantom)
                ->get(),
            'option'=>$option,
            'user'=>Auth::user()
        ]);
    }


}
