<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\BaseVan;
use \App\Models\Option;
use \App\Models\Component;
use Illuminate\Support\Facades\DB;

class PublicController extends Controller
{
    public function showBaseVans()
    {
    	$basevans = BaseVan::all();
    	return view('index::public.showBaseVans',['basevans'=>$basevans]);
    }

    public function showOptions( BaseVan $baseVan )
    {
    	return view('index::public.showOptions',['baseVan'=>$baseVan,'options'=> $baseVan->options->where('option_light_component',0)]);
    }

    public function showComponents( Option $option )
    {
        $option->with('components');
        return view('index::public.showComponents',['option'=> $option ]);
    }


    /**
     * returns a report showing where a stock code is used in options
     * @param  string      $componentStockCode stock code
     * @param  string|null $format             format for response
     * @return view
     */
    public function showWhereUsed( string $componentStockCode, string $format = null )
    {
        // Grab the stock code - quickest way to get description
        $component = Component::where('component_stock_code',$componentStockCode)->first();

        if (!$component)
        {
            return "Not Found";
        }

        // Grab the locations where used, joined with options table and base_vans
    	$whereUsed = DB::table('components')
			->select([
                'options.option_description AS option_description',
                'components.component_stock_code',
                'components.component_material_qty',
                'components.component_unit_of_measure',
                'options.option_name',
                'options.id AS option_id',
                'base_vans.name AS base_van'])
    		->where('component_stock_code', $componentStockCode )
			->leftJoin('options','components.option_id','=','options.id')
			->leftJoin('base_vans','options.base_van_id','=','base_vans.id')
			->get();


        if ($format === 'json')
        {
            return $whereUsed->toJson();
        }


        if ($format === 'array')
        {
            return $whereUsed->toArray();
        }

        /*
            Paired down view with no styling
         */
        if ($format === 'simple')
        {
            return view('index::public.showWhereUsedSimple',['stockCode'=>$component,'whereUsed'=> $whereUsed ]);
        }

        /*
            return a nicely formatted report if no other format was requested.
         */
        return view('index::public.showWhereUsed',['stockCode'=>$component,'whereUsed'=> $whereUsed ]);
    }




    public function showDrawings()
    {

    }
}
