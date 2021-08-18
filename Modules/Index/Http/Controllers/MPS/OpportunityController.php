<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\OpportunityLog;
use Illuminate\Http\RedirectResponse;
use App\Models\FunnelStatus;
use Illuminate\View\View;

class OpportunityController extends Controller
{

	public $dateValidations = [
		"chassis_order_date" => "nullable|date",
		"chassis_arrival_date" => "nullable|date",
		"material_needed_date" => "nullable|date",
		"material_order_date" => "nullable|date",
		"production_start_date" => "nullable|date",
		"production_completion_date" => "nullable|date",
		"shipping_date" => "nullable|date",
		"expected_win_date" => "nullable|date",

	];


	/**
	 * @param FunnelStatus|null $funnelStatus
	 * @return View
	 */
	public function create( FunnelStatus $funnelStatus = null): View
	{
		$dealers = Company::where('id','>',1)->pluck('name','id');
		return view('index::mps.opportunities.create', ['dealers'=>$dealers, 'funnelStatus'=>$funnelStatus] );
	}

	/**
	 * @param Request $request
	 * @return RedirectResponse
	 */
	public function store( Request $request ): RedirectResponse
	{
		$request->validate(array_merge([
			"salesperson_number" => "required|string|max:20",
			'customer' => "required|string|max:100",
			"description" => "required|string|max:100",
			"funnel_status_id" => "required|int",
			"company_id" => "required|int",
			"currency" => "required|string|max:3",
			"value" => "required|int",
			"department_id" => "required|int",

		],$this->dateValidations ));

		$opp = new Opportunity( $request->all() );
		$opp->user_id = Auth::user()->id;
		$opp->save();

		return redirect('/mps/opportunity/'. $opp->id );
	}

	/**
	 * @param Opportunity $opportunity
	 * @return View
	 */
	public function edit( Opportunity $opportunity ): View
	{
		$dealers = Company::where('id','>',1)->pluck('name','id');

		return view('index::mps.opportunities.edit', ['o' => $opportunity,'dealers'=>$dealers]);
	}


	/**
	 * @param Request $request
	 * @param Opportunity $opportunity
	 * @return RedirectResponse
	 */
	public function update( Request $request, Opportunity $opportunity ): RedirectResponse
	{
		$request->validate(array_merge( [
			"salesperson_number" => "sometimes|required|string|max:20",
			'customer' => "sometimes|required|string|max:100",
			"description" => "sometimes|required|string|max:100",
			"funnel_status_id" => "sometimes|required|int",
			"company_id" => "sometimes|required|int",
			"currency" => "sometimes|required|string|max:3",
			"value" => "sometimes|required|integer",
			"department_id" => "required|int",

		], $this->dateValidations ) );

		$old = $opportunity->replicate();


		$opportunity->update( $request->all() );

		foreach( $opportunity->getChanges() as $col => $newValue)
		{
			if( $col != 'updated_at')
			{
				$log = new OpportunityLog([
					'user_id' => Auth::user()->id,
					'field' => $col,
					'opportunity_id' => $opportunity->id,
					'old_value' => $old->$col ?? '[not set]',
					'new_value' => $newValue ?? "[not set]",
					'note' => 'x',
				]);
				$log->save();
			}
		}



		return redirect('/mps/opportunity/'. $opportunity->id );
	}


	/**
	 * @param Opportunity $opportunity
	 * @return View
	 */
	public function show( Opportunity $opportunity ): View
	{
		return view('index::mps.opportunities.show', ['opportunity' => $opportunity ] );
	}


	public function get( Opportunity $opportunity ): string
	{
		return $opportunity->toJson();
	}
}
