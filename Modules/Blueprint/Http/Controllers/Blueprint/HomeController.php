<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use Modules\Blueprint\Jobs\UpgradeBlueprint;


class HomeController extends Controller
{

    /**
     * home page of an individual blueprint
     *
     * @param Blueprint $blueprint
     * @return View
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint ): View
    {
        $this->authorize('home', $blueprint );

        // trigger upgrade event
        UpgradeBlueprint::dispatch( $blueprint );

        return view('blueprint::blueprint.home', [
            'blueprint' => $blueprint
        ]);
    }




}
