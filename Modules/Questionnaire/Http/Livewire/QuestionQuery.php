<?php

namespace Modules\Questionnaire\Http\Livewire;

use App\Models\WizardAction;
use App\Models\WizardAnswer;
use App\Models\WizardQuestion;
use Livewire\Component;

class QuestionQuery extends Component
{
    public WizardQuestion $question;

   //
    // public $text;
    public $answers;
    public int $wizard_id;
    public int $answersThatPointToThisQuestion = 0;
    public int $newAnswerQuestion = 0;
    public string $newAnswerText = "";
    public string $newAnswerNext = "";

    public function mount()
    {
        $this->answers = null;
//        $this->wizard_id = null;
    }

    protected $listeners = [
        "pickQuestion",
//        'render',
        'pickQuestionById',
    ];

    protected  array $rules = [
        "newAnswerText" => "required|string",
        "newAnswerQuestion" => "required|int",
        'answers.*.wizard_id' => 'int',
        'answers.*.text' => "string",
        'answers.*.next' => "nullable",
        'answers.*.wizard_question_id' => 'required|int',
        'question.text' => 'required|string',
        'question.type' => 'nullable|string',
    ];


    public function reRender()
    {
        $this->render();
    }


    /**
     * @param int $question
     */
    public function pickQuestionById( int $question ): void
    {
      //  dd( $question );
        $this->question = WizardQuestion::find( $question );
        $this->newAnswerQuestion = $this->question->id;
        $this->answersThatPointToThisQuestion = WizardAnswer::where('next',  $this->question->id)->count();
    }

    public function pickQuestion( string $msg )
    {
        $this->question = WizardQuestion::where('id', (int) ltrim($msg, 'Q') )
            ->with('answers', 'answers.actions', 'answers.actions.option')
            ->first();
        $this->newAnswerQuestion = $this->question->id;
        $this->answersThatPointToThisQuestion = WizardAnswer::where('next',  $this->question->id)->count();
    }


    public function saveText()
    {
        $this->question->save();
    }

    public function save()
    {
 //       $this->question->text = $this->text;
        $this->question->save();

        foreach( $this->answers as $answer )
        {
            $answer->save();
            //    WizardAnswer::find( $answer['id'])->update( $)
        }

        return redirect('/questionnaire/'. $this->wizard_id . '/graph' );
    }


    /**
     * @param WizardAnswer $answer
     */
    public function deleteAnswer( WizardAnswer $answer ): void
    {
        $id = $answer->wizard_question_id;
        $answer->delete();
        $this->pickQuestionById( $id );
    }

    public function deleteQuestion( WizardQuestion $q )
    {
        $q->delete();
        return redirect('/questionnaire/'. $this->wizard_id . '/graph' );

    }


    /**
     * @param WizardAction $action
     */
    public function deleteAction( WizardAction $action ): void
    {
        $action->delete();
   //     $this->render();
      $this->pickQuestionById( $this->question->id );
     // $this->render();
    //  dd('ok');
    }




    public function addAnswer()
    {
        $this->validate();

        WizardAnswer::create([
            'wizard_question_id' => $this->question->id,
            'wizard_id' => $this->question->wizard_id,
            'text' => $this->newAnswerText,
            'next' => $this->newAnswerNext ?? null,
        ]);
        return redirect('/questionnaire/'. $this->wizard_id . '/graph' );

    }


    public function render()
    {
        return view('questionnaire::questionQuery');
    }
}
