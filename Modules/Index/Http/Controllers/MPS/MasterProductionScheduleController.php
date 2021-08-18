<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Opportunity;
use Illuminate\Http\Request;

class MasterProductionScheduleController extends Controller
{
	public function index()
	{
		$budgets = \App\Models\MonthlyBudget::orderBy('month')->get();

		return view('index::mps.schedule.master', [
			'budgets' => $budgets,
		]);
	}


	public function test( Opportunity $opportunity )
	{
		return $opportunity->toJson();

	//	return view('index::mps.schedule.changeDate',['opportunity'=>$opportunity]);

	}

	public function changeCompletionDate( Request $request, Opportunity $opportunity )
	{
		$opportunity->production_completion_date = $request->production_completion_date;
		$opportunity->save();

		return redirect("/mps/schedule/master");
	}
}
