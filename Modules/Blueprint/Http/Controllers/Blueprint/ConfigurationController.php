<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Configuration;

class ConfigurationController extends Controller
{

    /**
     * show all active configurations
     *
     * @param Blueprint $blueprint
     * @return View
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint ): View
    {



        $configs = Configuration::where('blueprint_id', $blueprint->id )
            ->where('obsolete', false)
            ->with('option')
            ->get();
       //     ->distinct('name');


        /* TODO */
      //  $this->authorize('home', $blueprint );

//        $configuration = $blueprint->c

        return view('blueprint::configuration.show', [
            'blueprint' => $blueprint,
            'configurations' => $configs,
        ]);
    }

}
