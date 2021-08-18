<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Opportunity;
use Illuminate\View\View;
use Carbon\Carbon;

class DepartmentController extends Controller
{
	/*
	 * @param User $user
	 * @param FunnelStatus $funnelStatus
	 * @return \Illuminate\Contracts\View\Factory|View
	 */
	public function show( Department $department ): View
	{
		$opps = Opportunity::where('department_id', $department->id )
			->with('status')
			->where('funnel_status_id','>',40)
			->where('funnel_status_id','<',60)
			->whereDate('production_completion_date','>', Carbon::now() )
			->get();

		return view('index::mps.departments.show', [
			'department'=> $department,
			'opportunities' => $opps,
		]);
	}
}
