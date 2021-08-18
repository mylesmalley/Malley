<?php

namespace Modules\Index\Http\Controllers\Option;

use Illuminate\Http\Request;
use App\Models\Option;
use App\Models\OptionRule;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class RuleController extends Controller
{
	/**
	 * @param Option $option
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function rules( Option $option )
    {
	    // ids of options that are currently tied to the template
	    $ids = $option->rules->pluck( 'rule_type', 'related_option_id' )->toArray();

	    $inverseIds = DB::table('option_rules')
		                ->where('related_option_id', $option->id)
		                ->get()
		                ->keyBy('option_id')
						->toArray();


	    //$ids = $option->rules->pluck('option_id');

	  //  dd( $ids );

	    $options = Option::where( 'base_van_id', $option->base_van_id )
            ->where('obsolete', false)
		    ->where('id','!=',$option->id)
		    ->orderBy('option_name','ASC')
		    ->get();


	    $rowClasses = [
		    "CANT" => "table-danger",
		    "MUST" => "table-success",
		    "ONEA" => "table-info",
		    "ONEB" => "table-info",
		    "ONEC" => "table-info",
	    ];


	    return view( 'index::options.rules', [
	    	'option' => $option,
		    'basevan' => $option->platform(),
		    'options' => $options,
		    'inverse' => $inverseIds,
		    'rowClasses' => $rowClasses,
		    'currentOptions' => $ids,
	    ] );
    }

	/**
	 * @param Request $request
	 * @param Option $option
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function store( Request $request, Option $option )
    {
    	//dd( $request->all());

	    DB::table( 'option_rules' )
		    ->where( 'option_id', $option->id )
		    ->delete();

	    DB::table( 'option_rules' )
		    ->where( 'related_option_id', $option->id )
		    ->delete();




	    if ( count( $request->option ) ) {
		    foreach ( $request->option as $optionID => $ruleTye ) {
		    	if ($ruleTye)
			    {
				    $t = new OptionRule( [
					    'option_id' => $option->id,
					    'rule_type' => $ruleTye,
					    'related_option_id' => $optionID,
				    ] );
				    $t->save();
			    }

		    }
	    }

	    if ( count( $request->inverse ) ) {
		    foreach ( $request->inverse as $inverse => $ruleTye ) {
			    if ($ruleTye)
			    {
				    $t = new OptionRule( [
					    'option_id' =>$inverse,
					    'rule_type' => $ruleTye,
					    'related_option_id' => $option->id,
				    ] );
				    $t->save();
			    }

		    }
	    }



	    return redirect( "/index/option/{$option->id}/home" );

    }
}
