<?php

namespace Modules\Questionnaire\Http\Livewire;

use App\Models\WizardAction;
use App\Models\WizardAnswer;
use App\Models\WizardQuestion;
use Illuminate\View\View;
use Livewire\Component;

class NewAction extends Component
{

    public WizardAnswer $answer;

    public WizardAction $action;


    public array $rules = [
        'action.action' => 'required|string',
        'action.option_id' => 'required|integer',
        'action.wizard_answer_id' => 'required|integer',
        'action.value' => 'required|integer',
    ];


    /**
     * @param WizardAnswer $answer
     */
    public function mount( WizardAnswer $answer )
    {
        $this->answer = $answer;
        $this->action = new WizardAction();
        $this->action->wizard_answer_id = $answer->id;
        $this->action->value = 1;
    }


    public function save()
    {
       // dd( $this->action );

        $this->validate();
        $this->action->save();
        $this->emit('pickQuestionById', $this->answer->wizard_question_id );


    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('questionnaire::newAction');
    }

}