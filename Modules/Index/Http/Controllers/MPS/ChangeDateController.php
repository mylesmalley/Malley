<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Opportunity;
use Illuminate\View\View;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ChangeDateController extends Controller
{
	
	
	public function test( Request $request )
	{
	//	dd( $request->all() );
		$opp = Opportunity::findOrFail( $request->opportunity_id );
		
		$col = $request->date_column;
		
		$opp->$col = $request->date;
		
		$opp->save();
		
	//	return response($opp )->json();
	}
	

}