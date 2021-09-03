<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use App\Models\Configuration;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;


class FloorLayoutController extends Controller
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

        return view('blueprint::floor_layout.show', [
            'blueprint' => $blueprint,
            'configuration' => $blueprint->activeOptionNames(),
        ]);
    }



    /**
     * handle the changes made to the floor
     * layout as they happen. mostly just staging
     *
     * @param Blueprint $blueprint
     * @param Request $request
     * @return JsonResponse
     */
    public function change(Blueprint $blueprint, Request $request ):  JsonResponse
    {
        $blueprint->update([
            'custom_layout' => $request->input('layout'),
        ]);

        return response()->json([
            'message' => 'Success'
        ]);
    }


    /**
     * actually adds the staged configuration to the
     * blueprint based on the custom layout stored.
     *
     * @param Blueprint $blueprint
     * @return RedirectResponse
     */
    public function store( Blueprint $blueprint ): RedirectResponse
    {
        $layout = json_decode( $blueprint->custom_layout );

        foreach( $layout->children as $c )
        {
            foreach( $c->attrs->options as $o)
            {
                 $config = Configuration::where('blueprint_id', $blueprint->id)
                    ->where('name', $o )
                    ->where('obsolete', false)
                    ->first();

                 $config->update([
                     'value' => 1,
                     'quantity' => $config->quantity + 1,
                 ]);
            }
        }

        return redirect()
            ->route('blueprint.home', [$blueprint])
            ->with('success','Floor layout added to this Blueprint');
    }

}
