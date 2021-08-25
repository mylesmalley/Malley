<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Http\Request;

class ConfigurationController extends Controller
{

    /**
     * show all active configurations
     *
     * @param Blueprint $blueprint
     * @param Request $request
     * @return View
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint, Request $request ): View
    {
        $this->authorize('edit_configuration', $blueprint);

        $request->validate([
            'showAll' => [
                'sometimes'
            ],
            'orderBy' => [
               'sometimes',
                Rule::in(['id','name','description','obsolete','value','price_tier_3','price_tier_2'])
            ],
            'order' => [
                'sometimes',
                Rule::in(['ASC','DESC'])
            ]
        ]);


        $showAll = $request->has('showAll');
        $orderBy = $request->has('orderBy') ? $request->input('orderBy') : 'name';
        $sortOrder = $request->has('order') ? $request->input('order') : 'ASC';


        $configs = Configuration::where('blueprint_id', $blueprint->id )
            ->where('obsolete', false)
            // narrow things down a bit...
            ->select([
                'id','name','description','obsolete','value','price_tier_3','price_tier_2'
            ])
            // don't filter at all if showAll is present
            ->when($showAll, function( $query ) {  })
            // filter all but value > 0 if showAll not present
            ->when(!$showAll, function( $query ) {
                return $query->where('value', '>', 0);
            })
            // handle sort order and direction if present
            ->when($orderBy, function( $query, $orderBy ) use ($sortOrder) {
                return $query->orderBy( $orderBy, $sortOrder );
            })
            ->get();

        // lets role!
        return view('blueprint::configuration.show', [
            'blueprint' => $blueprint,
            'configurations' => $configs,
        ]);
    }


    /**
     * reset the blueprint's configuration to have everything
     * turned off. also clears out selected answers from wizards.
     *
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
            ->with('success','Successfully reset this blueprint\'s configuration');
    }
}
