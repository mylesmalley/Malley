<?php

namespace Modules\Blueprint\Http\Livewire;

use App\Models\Wizard;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Blueprint;

class Progress extends Component
{

    public array $progress;
    public Wizard $wizard;
    public Blueprint $blueprint;
    protected $listeners = [ "submittedAnswers" ];

    public function mount()
    {
        $this->update();
    }

    public function submittedAnswers()
    {
        $this->update();
    }


    public function update()
    {
        $this->progress = DB::table('blueprint_wizard_answers')
            ->select(["blueprint_wizard_answers.id",
                "wizard_questions.text as question",
                "wizard_answers.text as answer",
                "wizard_answer_id",
                'blueprint_wizard_answers.wizard_id',
            ])
            ->where('blueprint_id', $this->blueprint->id )
            ->where('blueprint_wizard_answers.wizard_id', $this->wizard->id )
            ->leftJoin('wizard_questions', 'wizard_questions.id','=','blueprint_wizard_answers.wizard_question_id')
            ->leftJoin('wizard_answers', 'wizard_answers.id','=','blueprint_wizard_answers.wizard_answer_id')
            ->get()
            ->toArray();
    }





    public function render()
    {
        return view('blueprint::wizard.progress_component');
    }
}
