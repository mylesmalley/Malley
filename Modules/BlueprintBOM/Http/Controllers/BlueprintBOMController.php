<?php

namespace Modules\BlueprintBOM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\Blueprint;
use App\Models\Option;

class BlueprintBOMController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        return view('blueprintbom::index');
    }


    /**
     * @param Blueprint $blueprint
     * @return string
     */
    public function configuration( Blueprint $blueprint): string
    {

        $selectedOptions =  $blueprint->configuration
            ->where('obsolete', false )
            ->where('value', 1)
            ->pluck('option_id');

        $options = Option::select(['id','option_name','option_description','option_syspro_phantom'])
            ->where('option_name', 'not like', '%Z%')
            ->whereIn('id', $selectedOptions )
            ->with(['components' => function($query) {
               $query->select('id','option_id','component_stock_code',
                   'component_description', 'component_material_qty',
                   'component_unit_of_measure');
            }])->get();

         return $options->toJson();

    }
}
