<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Opportunity;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Carbon\Carbon;

class DatesController extends Controller
{
	public function get( Request $request )
	{
		
		$column = ( in_array( $request->column, Opportunity::dateColumns() ) ) ? $request->column : 'production_completion_date';
		$start = date( 'Y-m-d', strtotime( $request->start ) );
		$end = date( 'Y-m-d', strtotime( $request->end ) );
		//return $request->all();
		
		
		$values = Opportunity::where( $column, '!=', null )
			->whereDate( $column, '>=', $start )
			->whereDate( $column, "<=", $end )
			->get();

		$dates = [];
		
		foreach( $values as $opp )
		{
	
				$dates[] = [
					"id" => $opp->id,
					"title" => $opp->description ,
					"allDay" => true,
					"start" => $opp->$column->format('Y-m-d'),
					"backgroundColor" => $opp->backgroundColour(),
					"textColor" => $opp->textColour(),
					"extendedProps" => [
						'opportunity_id' => $opp->id,
						'date_column' => $column,
					]
				];
		}
		//dd( $dates );
		return response()->json(
			$dates
		);
	}




}