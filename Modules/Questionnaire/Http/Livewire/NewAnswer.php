<?php

namespace Modules\Questionnaire\Http\Livewire;

use App\Models\WizardAnswer;
use App\Models\WizardQuestion;
use Illuminate\View\View;
use Livewire\Component;

/**
 *
 */
class NewAnswer extends Component
{

    public WizardQuestion $question;

    public WizardAnswer $answer;

    /**
     * @var array|string[]
     */
    public array $rules = [
        "answer.text" => "required|string",
        "answer.next" => "required|integer", // question after this answer
        "answer.wizard_question_id" => "required|integer",
        "answer.notes" => "nullable|string",
        "answer.wizard_id" => "required|integer",

    ];


    /**
     * @param WizardQuestion $question
     */
    public function mount( WizardQuestion $question ): void
    {
        $this->question = $question;
        $this->answer = new WizardAnswer();
        $this->answer->wizard_id = $this->question->wizard_id;
        $this->answer->wizard_question_id = $this->question->id;
    }


    /**
     *
     */
    public function save(): void
    {
        $this->validate();
        $this->answer->save();
        $this->emit('pickQuestionById', $this->question->id );
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('questionnaire::newAnswer');
    }

}