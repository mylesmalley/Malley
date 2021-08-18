<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\FunnelStatus;
use App\Models\Opportunity;
use App\Models\OpportunityLog;
use Illuminate\View\View;
use Carbon\Carbon;

class OpportunityLogController extends Controller
{
	public function show( Opportunity $opportunity ): View
	{
		$logs = OpportunityLog::where('opportunity_id', $opportunity->id )
			->with(['user','opportunity'])
			->orderBy('created_at','DESC')
			->get();

		$departments = Department::pluck('name','id')->toArray();
		$funnelStatus = FunnelStatus::pluck('name','id')->toArray();

		return view('index::mps.logs.show', [
			'logs' => $logs,
			'opportunity' => $opportunity,
			'departments' => $departments,
			'funnelStatus' => $funnelStatus,
		]);
	}
}
