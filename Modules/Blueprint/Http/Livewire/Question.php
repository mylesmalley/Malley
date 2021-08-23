<?php

namespace Modules\Blueprint\Http\Livewire;

use App\Models\WizardAnswer;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;
use App\Models\Wizard;
use App\Models\WizardQuestion;
use App\Models\BlueprintWizardAnswer;

class Question extends Component
{

    public Blueprint $blueprint;
    public Wizard $wizard;
    public Collection $progress;
    public WizardQuestion $question;
    public Collection $selectedAnswers;
    public array $options = [];

    public function mount()
    {
        $this->selectedAnswers = collect([]);

        $this->updateProgress();
        $this->updateQuestion();
    }


    /**
     * maintains the history of the form
     */
    public function updateProgress()
    {

        $this->progress = BlueprintWizardAnswer
            ::where( 'blueprint_id', $this->blueprint->id)
            ->where('wizard_id', $this->wizard->id)
            ->orderBy('id','DESC')
            ->get();

        $this->selectedAnswers = BlueprintWizardAnswer
            ::where( 'blueprint_id', $this->blueprint->id)
            ->where('wizard_id', $this->wizard->id)
            ->pluck('wizard_answer_id');

        // update the progress component
        $this->emit('submittedAnswers');

    }


    /**
     * Handles which question should be shown to the user when the wizard is loaded.
     * Allows for restarting a wizard mid-way, and handles special redirection questions
     */
    public function updateQuestion()
    {
        // if no progress is saved, start the wizard from its defined starting point
        if (!count($this->progress))
        {
            // grab the wizard starting point
            $this->question = $this->wizard->startWizard();
        }
        // the wizard is already in progress
        else
        {
            // grab the most recently saved answer and grab it's next question
            $tmp = WizardAnswer::find( $this->progress->first()->wizard_answer_id )->nextQuestion();

            // if the next question is a redirect type,
            if ( $tmp->type === 'redirect')
            {
                // handle it using the WizardAnswer model's redirect function
                $this->question = $tmp->redirect( $this->selectedAnswers );
            }
            else
            {
                // otherwise, use the one you've found.
                $this->question = $tmp;
            }
        }
    }


    public function restart()
    {
        BlueprintWizardAnswer::where([
            'blueprint_id' => $this->blueprint->id,
            "wizard_id" => $this->wizard->id,
        ])->delete();

        // empty selected options
        $this->options = [];

        $this->updateProgress();
        $this->updateQuestion();

        return redirect()->route('blueprint.questionnaire', [
            $this->blueprint->id,
            $this->wizard->id
        ]);
    }


    public function back()
    {
        // grab the last question answered. get the first instance if multiples are picked.
        $lastAnsweredQuestionid = BlueprintWizardAnswer::where([
            'blueprint_id' => $this->blueprint->id,
            "wizard_id" => $this->wizard->id,
        ])->orderBy('id','DESC')
            ->first()->wizard_question_id ;

        BlueprintWizardAnswer::where([
            'blueprint_id' => $this->blueprint->id,
            "wizard_id" => $this->wizard->id,
            'wizard_question_id' => $lastAnsweredQuestionid,
        ])->delete();

        $this->options = [];

        $this->updateProgress();
        $this->updateQuestion();
    }


    /**
     * Handles when a specific answers is chosen from a question
     *
     * @param int $answer_id
     */
    public function submitAnswers( int $answer_id )
    {
        // add the new database record as needed
        BlueprintWizardAnswer::create([
            'blueprint_id' => $this->blueprint->id,
            'wizard_answer_id' => $answer_id,
            "wizard_question_id" => $this->question->id,
            "wizard_id" => $this->wizard->id,
        ]);

        $this->updateProgress();

        // keep going in the questionnaire
        $this->updateQuestion();

        // empty selected options
        $this->options = [];


    }


    /**
     *  handles when a question with checkboxes is submitted
     */
    public function submitOptions()
    {
        // if options have been selected...
        if( count($this->options ))
        {
            // loop through and save them.
            foreach( $this->options as $opt )
            {
                BlueprintWizardAnswer::create([
                    'blueprint_id' => $this->blueprint->id,
                    'wizard_answer_id' => $opt,
                    "wizard_question_id" => $this->question->id,
                    "wizard_id" => $this->wizard->id,
                ]);
            }
        }

        // empty selected options
        $this->options = [];

        // take the first 'next question' from the available answers as tehy all go the same place
        $this->question =  $this->question->answers->first()->nextQuestion();

        // updates this components' store of progress
        $this->updateProgress();

    }



    public function render()
    {
        return view('blueprint::questionnaire.question_component');
    }
}
