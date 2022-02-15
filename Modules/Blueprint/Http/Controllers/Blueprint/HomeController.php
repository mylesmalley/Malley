<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use Modules\Blueprint\Jobs\UpgradeBlueprint;


class HomeController extends Controller
{

    /**
     * home page of an individual blueprint
     *
     * @param Blueprint $blueprint
     * @return Response
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint ): Response
    {
        $this->authorize('home', $blueprint );

        // trigger upgrade event
        UpgradeBlueprint::dispatch( $blueprint );

        $blueprint->load('platform', 'platform.forms');

        return response()
            ->view('blueprint::blueprint.home', [
            'blueprint' => $blueprint,
            'configuration' => $blueprint->activeOptionNames(),
            'forms' => $blueprint->platform->forms,
        ]);
    }




}
