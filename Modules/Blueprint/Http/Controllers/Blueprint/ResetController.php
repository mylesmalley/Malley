<?php

namespace Modules\Blueprint\Http\Controllers\Blueprint;

use Illuminate\Auth\Access\AuthorizationException;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\RedirectResponse;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;
use App\Models\Configuration;
use Illuminate\Support\Facades\Log;

class ResetController extends Controller
{

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
                'value' => 0,
                'quantity' => 1
            ]);

        $blueprint->update([
            'custom_layout' => '',
        ]);


        // clear out the selected answers so the forms are reset too.
        BlueprintWizardAnswer::where('blueprint_id', $blueprint->id)->delete();
        Log::info("B-$blueprint->id reset by user");

        return redirect()
            ->route('blueprint.home', [ $blueprint ])
            ->with('success','Successfully reset this blueprint\'s configuration');
    }
}
