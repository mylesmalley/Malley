<?php

namespace Modules\Blueprint\Http\Controllers\Wizard;

use App\Models\Blueprint;
use App\Models\Wizard;
use App\Models\Configuration;
use App\Models\BlueprintWizardAnswer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;

class WizardController extends Controller
{


    /**
     * Renders the wizard - which actually just loads the livewire components
     * for questions and progress.
     *
     * @param Blueprint $blueprint
     * @param Wizard $wizard
     * @return Response
     */
    public function show(Blueprint $blueprint, Wizard $wizard ): Response
    {
        return response()
            ->view('blueprint::wizard.show',
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
        $blueprint_answers = BlueprintWizardAnswer::where([
            'blueprint_id' => $blueprint->id,
            'wizard_id' => $wizard->id,
        ])->with('answer','answer.actions')
            ->orderBy('id')
            ->get();//->pluck('wizard_answer_id');


        // grab the actions for those answers. can be multiple
        //$actions = WizardAction::whereIn('wizard_answer_id', $answers )->get();

        // loop through and process each action
        foreach( $blueprint_answers as $blueprint_answer )
        {
            foreach( $blueprint_answer->answer->actions as $action )
            {
                $action->do( $blueprint->id );
            }
        }

       // dd( $do );

        if ( $wizard->completed_form_option )
        {
            //dd( $wizard->completed_form_option );

            Configuration::where('blueprint_id', $blueprint->id)
                ->where('name', $wizard->completed_form_option )
                ->update([
                    'value' => 1,
                ]);
        }

        // return to the home page of the blueprint
        return redirect()->route('blueprint.home', [ $blueprint->id ]);
    }
}
