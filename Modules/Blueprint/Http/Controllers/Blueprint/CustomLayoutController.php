<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\Configuration;
use App\Models\CustomLayout;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;


class CustomLayoutController extends Controller
{

    protected array $custom_layout_locations = [
        "floor" => 'blueprint::floor_layout.show',
        'ceiling' => 'blueprint::floor_layout.show',
    ];


    /**
     * @param Blueprint $blueprint
     * @param string $location
     * @return View|RedirectResponse
     * @throws AuthorizationException
     */
    public function show( Blueprint $blueprint, string $location ): View|RedirectResponse
    {
        $this->authorize('home', $blueprint );

        if ( ! array_key_exists( $location, $this->custom_layout_locations ) )
        {
            Log::error("Tried to access a floor layout that isn't allowed.");
            return redirect()
                ->back()
                ->withErrors(["Error"=>"That custom layout area doesn't exist."]);
        }

        $layout = CustomLayout::firstOrCreate([
                    'name' => $location,
                    'blueprint_id' => $blueprint->id
                ]);

        if ($layout->wasRecentlyCreated) {
            Log::info("Created empty custom layout for B-".$blueprint->id." at ".$location);
        }


        return view('blueprint::custom_layouts.show', [
            'blueprint' => $blueprint,
            'layout' => $layout,
            'configuration' => $blueprint->activeOptionNames(),
        ]);
    }



    /**
     * handle the changes made to the custom layout
     * layout as they happen. mostly just staging
     *
     * @param Blueprint $blueprint
     * @param Request $request
     * @return JsonResponse|RedirectResponse
     */
    public function change(Blueprint $blueprint, string $name, Request $request ):  JsonResponse|RedirectResponse
    {


        try {
            $layout = CustomLayout::where( 'name', '=', $name)
                ->where( 'blueprint_id', '=', $blueprint->id)
                ->firstOrFail();
        }
        catch ( ModelNotFoundException $e )
        {
            Log::error("Custom layout $name for B-{$blueprint->id} not found");
            return redirect()
                ->back()
                ->withErrors(["Error"=>"That custom layout area doesn't exist."]);
        }


        // store the existing layout
        $old = json_decode( $layout->layout );

        // loop through the children components
        foreach( $old->children as $c )
        {
            if ( property_exists($c, 'attrs' ) &&  property_exists( $c->attrs, 'options') ) {
                // loop through each option associated to the component
                foreach ($c->attrs->options as $o) {
                    // grab the config item matching that option name
                    $config = Configuration::where('blueprint_id', $blueprint->id)
                        ->where('name', $o)
                        ->where('obsolete', false)
                        ->first();


                    // turn on an option that's turned off.
                    if ($config->value === 0) {
                        $config->update([
                            'value' => 1,
                            'quantity' => 1,
                        ]);
                    } // if the quantity is one, just turn it off
                    elseif ($config->quantity === 1) {
                        $config->update([
                            'value' => 0,
                            'quantity' => 1,
                        ]);
                    } // if the quantity is more than one, leave it on but lower it by one
                    else {
                        $config->update([
                            'value' => 1,
                            'quantity' => $config->quantity - 1,
                        ]);
                    }


                }
            }
        }



        // update the blueprint with the new layout
        $layout->update([
            'layout' => $request->input('layout'),
        ]);


        // loop through the new layout and update the configuration
        $configs_in_layout = json_decode(  $request->input('layout') );

        foreach( $configs_in_layout->children as $c )
        {
            if ( property_exists($c, 'attrs' ) &&  property_exists( $c->attrs, 'options') )
            {

                foreach( $c->attrs->options as $o)
                {
                    $config = Configuration::where('blueprint_id', $blueprint->id)
                        ->where('name', $o )
                        ->where('obsolete', false)
                        ->first();


                    if ( $config->value )
                    {
                        $config->update([
                            'quantity' => $config->quantity + 1,
                        ]);
                    }
                    // necessary because incrementing the quantity results in two if starting from the default
                    else
                    {
                        $config->update([
                            'value' => 1,
                            'quantity' => 1,
                        ]);
                    }
                }

            }
        }



        // hopefully works?
        return response()->json([
            'message' => 'Success'
        ]);
    }


}
