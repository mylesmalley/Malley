<?php

namespace Modules\Blueprint\Http\Controllers\Questionnaire;

use App\Models\Blueprint;
use App\Models\Wizard;
use App\Models\WizardAction;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\View\View;

class WizardController extends Controller
{


    /**
     * Renders the wizard - which actually just loads the livewire components
     * for questions and progress.
     *
     * @param Blueprint $blueprint
     * @param Wizard $wizard
     * @return View
     */
    public function show(Blueprint $blueprint, Wizard $wizard ): View
    {
        return view('blueprint::questionnaire.show',
            compact(['blueprint','wizard'])
        );
    }


    /**
     * loops through the answers from the wizard and processes them based on the rules
     * set out in the wizard_action table
     *
     * @param Blueprint $blueprint
     * @param Wizard $wizard
     * @return RedirectResponse
     */
    public function process( Blueprint $blueprint, Wizard $wizard  ): RedirectResponse
    {
        // grab the answers from the blueprint
        $answers = BlueprintWizardAnswer::where([
            'blueprint_id' => $blueprint->id,
            'wizard_id' => $wizard->id,
        ])->pluck('wizard_answer_id');

        // grab the actions for those answers. can be multiple
        $actions = WizardAction::whereIn('wizard_answer_id', $answers )->get();

        // loop through and process each action
        foreach( $actions as $action )
        {
            $action->do( $blueprint->id );
        }

        // return to the home page of the blueprint
        return redirect()->route('blueprint.home', [ $blueprint->id ]);
    }
}
