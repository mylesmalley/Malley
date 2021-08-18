<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use \Illuminate\Http\JsonResponse;

class OpportunityDatesController extends Controller
{
	
	/**
	 * @param Opportunity $opportunity
	 * @return JsonResponse
	 */
	public function get( Opportunity $opportunity ): JsonResponse
	{
		$dates = [];
		
		foreach( $opportunity->mpsDates as $date )
		{
			if ( $opportunity->$date )
			{
				$dates[] = [
					"id" => $date,
					"title" => ucwords( str_replace('_',' ', $date )),
					"allDay" => true,
					"start" => $opportunity->$date->format('Y-m-d'),
					"extendedProps" => [
						'opportunity_id' => $opportunity->id,
						'date_column' => $date,
					]
				];
			}
		}
		//dd( $dates );
		return response()->json(
			$dates
		);
	}
}