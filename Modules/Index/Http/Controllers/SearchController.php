<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function searchComponentsForm()
    {
    	return view('index::search.searchComponentsForm');
    }

    public function searchComponents( Request $request )
    {
    	$allVans = ( $request->baseVanId === "all") ? true : false;
    	$db = DB::table('components')
		    ->select([
		    	'components.component_stock_code',
			    'components.component_material_qty',
			    'options.option_name',
			    'options.base_van_id',
			    'components.option_id',
			    'options.option_description',
		    ])
		    ->leftJoin('options','components.option_id','=','options.id','left')
		    ->where('component_stock_code','like','%'.$request->searchTerm.'%')
		    ->when(!$allVans, function ($query) use ($request) {
			    return $query-> where('options.base_van_id', $request->baseVanId );
		    })
		    ->get();
    	return response()->json($db);
    }


    public function searchPhantomsForm()
    {
        return view('index::search.searchPhantomsForm');
    }


    public function searchPhantoms( Request $request )
    {
        $allVans = ( $request->baseVanId === "all") ? true : false;
        $db = DB::table('options')
            ->where('option_syspro_phantom','like','%'.$request->searchTerm.'%')
            ->where('obsolete', false)
            ->when(!$allVans, function ($query) use ($request) {
                return $query-> where('base_van_id', $request->baseVanId );
            })
            ->get();
        return response()->json($db);
    }
}
