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



    public function deleteAnswer( WizardAnswer $id )
    {
        $id->delete();
        return redirect('/questionnaire/'. $this->wizard_id . '/graph' );

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
//return <<<'blade'
//<div>
//    @if( $question)
//        <div class="card">
//            <div class="card-header text-white bg-primary">
//                Edit Question
//            </div>
//            <div class="row">
//                <div class="col-5">
//                    <form  wire:submit.prevent="save">
//                        <div class="input-group">
//                              <label for="text">Question Text</label>
//                              <input id="text" type="text" wire:model="text">
//                        </div>
//                        <div class="input-group">
//                            <input type="submit" class="btn btn-primary" value="Save">
//                        </div>
//                    </form>
//                </div>
//
//                <div class="col-7">
//                    @if( count($answers) || $answersThatPointToThisQuestion )
//
//                    <table>
//                        <thead>
//                            <tr>
//<!--                                <th>Parent Q</th>-->
//                                <th>Text </th>
//                                <th>Next Q</th>
//                                <th></th>
//                            </tr>
//                        </thead>
//                        <tbody>
//                               @foreach( $answers as $key => $value )
//                               <tr  wire:key="answer-field-{{ $value->id }}">
//<!--                                    <td>-->
//<!--                                                                            <input-->
//<!--                                            type="text"-->
//<!--                                            wire:model="answers.{{ $key }}.wizard_question_id" />-->
//<!--                                    </td>-->
//                                    <td>
//                                        <input
//                                            type="text"
//                                            class="form-control"
//                                            wire:model="answers.{{ $key }}.text" />
//                                    </td>
//                                    <td>
//                                        <input
//                                            type="text"
//                                            class="form-control"
//                                            wire:model="answers.{{ $key }}.next" />
//                                    </td>
//                                    <td>
//
//
//                                        <button class="btn btn-danger"
//                                                wire:click="deleteAnswer( {{ $answers[$key]['id']}} )">Delete</button>
//                                    </td>
//
//                                </tr>
//                                <tr>
//                                    <td colspan="3">
//                                        <table>
//                                            @foreach( $answers[$key]->actions as $a)
//                                            <tr>
//                                                 <td>{{ $a->id }}</td>
//                                            </tr>
//                                            </table>
//                                    @endforeach
//</td>
//</tr>
//
//                         @endforeach
//                                </tbody>
//                                </table>
//                         @else
//                            <button class="btn btn-danger"
//                                wire:click="deleteQuestion( {{ $question->id }})"
//                            >
//                            Delete This question?
//                            </button>
//
//                         @endif
//
//                    <table>
//                        <thead>
//                            <tr>
//<!--                                <th>Parent Q</th>-->
//                                <th>Text </th>
//                                <th>Next Q</th>
//                                <th></th>
//                            </tr>
//                        </thead>
//                            <tbody>
//
//                                <tr>
//                                    <td>
//                                        <input
//                                            type="text"
//                                            class="form-control"
//                                            wire:model="newAnswerText" />
//                                    </td>
//                                    <td>
//                                      <input
//                                            type="text"
//                                                                                        class="form-control"
//
//                                            wire:model="newAnswerNext" />
//                                    </td>
//                                    <td>
//                           <button
//                                class="btn btn-success"
//                            wire:click="addAnswer">Add</button>
//
//                                    </td>
//
//                                </tr>
//
//                        </tbody>
//
//                    </table>
//
//                </div>
//            </div>
//
//        </div>
//
//    @endif
//</div>
//blade;
    }
}
