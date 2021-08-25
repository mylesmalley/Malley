<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\RedirectResponse;
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
        $this->authorize('edit_configuration', $blueprint);

        $configs = Configuration::where('blueprint_id', $blueprint->id )
            ->where('obsolete', false)
            ->select([
                'id','name','description','obsolete','value','price_tier_3','price_tier_2'
            ])
            ->orderBy('name')
            ->get();


        return view('blueprint::configuration.show', [
            'blueprint' => $blueprint,
            'configurations' => $configs,
        ]);
    }


    /**
     * @param Blueprint $blueprint
     * @return RedirectResponse
     * @throws AuthorizationException
     */
    public function reset( Blueprint $blueprint ): RedirectResponse
    {
        $this->authorize('reset_configuration', $blueprint );

        Configuration::where('blueprint_id', $blueprint->id )
            ->update([
                'value' => 0
            ]);

        // clear out the selected answers so the forms are reset too.
        BlueprintWizardAnswer::where('blueprint_id', $blueprint->id)->delete();

        return redirect()
            ->route('blueprint.home', [ $blueprint ])
            ->with('message','Successfully reset this blueprint\'s configuration');
    }
}
