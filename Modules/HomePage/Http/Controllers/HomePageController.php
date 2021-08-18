<?php

namespace Modules\HomePage\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use \Illuminate\View\View;
use App\Models\Blueprint;
use App\Models\BaseVan;
//use App\Models\WarrantyClaim;

class HomePageController extends Controller
{

	/**
	 * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
	public function index(): \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
    {
		$blueprints = Blueprint::with(['user','platform','user.company'])
								->limit(5)
								->orderBy('id','DESC')
								->get();

//		$claims = WarrantyClaim::limit(5)
//			->orderBy('id','DESC')
//			->get();

        $announcement = Announcement::randomItem();

		$baseVans = BaseVan::select(['id','name'])->get();

		return view( 'homepage::index',
			[
				'blueprints' => $blueprints,
//				'claims' => $claims,
                'announcement' => $announcement,
                'baseVans' => $baseVans,
			]);
	}

}
