<?php

namespace App\Http\Controllers\MPS;

use App\Http\Controllers\Controller;
use App\Models\FunnelStatus;
use App\Models\User;
use App\Models\Opportunity;
use Illuminate\View\View;

class SalesFunnelController extends Controller
{
	/**
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function index(): View
	{
		$funnels = FunnelStatus::with('opportunities.user','opportunities','opportunities.dealer')
			//->where('id', '<',50)
			->get();

		//dd( $data );
		return view('index::mps.sales.funnel', ['funnels' => $funnels ]);
	}

	/**
	 * @param User $user
	 * @param FunnelStatus $funnelStatus
	 * @return \Illuminate\Contracts\View\Factory|View
	 */
	public function show( User $user, FunnelStatus $funnelStatus)
	{
		$opps = Opportunity::where( 'user_id','=', $user->id )
			->where('funnel_status_id', $funnelStatus->id )
			->get();

		return view('index::mps.funnel.show', [
			'opportunities' => $opps,
			'user' => $user,
			'funnelStatus' => $funnelStatus,
		]);
	}
}
