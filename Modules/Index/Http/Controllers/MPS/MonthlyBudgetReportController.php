<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;

class MonthlyBudgetReportController extends Controller
{
	public function index()
	{
		return view('index::mps.index');
	}
}
