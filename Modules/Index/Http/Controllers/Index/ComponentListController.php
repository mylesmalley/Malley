<?php

namespace Modules\Index\Http\Controllers\Index;


use App\Models\Option;
use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use Illuminate\View\View;


class ComponentListController extends Controller
{

    /**
     * @param BaseVan $baseVan
     */
    public function report(BaseVan $baseVan): View
    {
        $options = Option::where('base_van_id', '=', $baseVan->id )
            ->with(['components' => function($query){
                  //  $query->select('component_stock_code', 'component_description','component_material_qty');
            }])
            ->where('obsolete', '=', false)
            ->where('no_components', '=', false)
            ->select(['id', 'option_name', 'option_description'])
            ->get();

        return view('index::index.reports.component_listing', [ 'options' => $options ]);
    }

}
