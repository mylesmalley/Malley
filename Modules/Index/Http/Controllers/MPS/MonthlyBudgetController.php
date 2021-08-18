<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use \App\Models\MonthlyBudget;
use Illuminate\Http\Request;

class MonthlyBudgetController extends Controller
{
	public function index()
	{
	    $budgets = MonthlyBudget::orderBy('month','ASC')->get();

		return view('index::mps.budgets.index', ['budgets'=>$budgets]);
	}

    public function create()
    {
        return view('index::mps.budgets.create');
    }

    public function store( Request $request )
    {
        $request->validate([
        	'month' => 'required|date|unique:monthly_budgets,month',
	        'budget_ambulance' => 'required|integer',
	        'budget_mobility' => 'required|integer',
	        'budget_commercial' => 'required|integer',
	        'budget_plastics' => 'required|integer',
	        'budget_refurbished' => 'required|integer',
	        'budget_other' => 'required|integer',
	        'usd_exchange_rate' => 'required|numeric'
        ]);

        $budget = new MonthlyBudget( $request->all() );
		$budget->save();
		return redirect('/mps/budgets');
    }

    public function edit( MonthlyBudget $budget )
    {
    	return view('index::mps.budgets.edit',[ 'budget'=> $budget ]);
    }

    public function update( Request $request, MonthlyBudget $budget )
    {
	    $request->validate([
		    'budget_ambulance' => 'required|integer',
		    'budget_mobility' => 'required|integer',
		    'budget_commercial' => 'required|integer',
		    'budget_plastics' => 'required|integer',
		    'budget_refurbished' => 'required|integer',
		    'budget_other' => 'required|integer',
		    'usd_exchange_rate' => 'required|numeric'
	    ]);

	    $budget->update( $request->all() );

	    return redirect('/mps/budgets');
    }
}
