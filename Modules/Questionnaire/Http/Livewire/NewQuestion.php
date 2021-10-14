<?php

namespace Modules\Questionnaire\Http\Livewire;

use Livewire\Component;
use App\Models\WizardQuestion;

class NewQuestion extends Component
{
    public string $text = "Question Text";
    public int $wizard_id;

    public function add( )
    {
        $q = WizardQuestion::create([
            'wizard_id' => $this->wizard_id,
            'text' => $this->text
        ]);

        $q->save();
        return redirect('/questionnaire/'. $this->wizard_id . '/graph' );
    }


    public function render()
    {
        return <<<'blade'
            <div class="text-center">
               <div class="card border-success">
                    <div class="card-header bg-success text-white">
                    Mew Question
                    </div>
                    <div class="card-body">
                         <form >
                           <form  wire:submit.prevent="save">
                            <div class="input-group">
                                <label for="text">New Question</label>
                                <input type="text"
                                name="text"
                                id="text"
                                wire:model="text"
                                 class="form-control"
                            </div>
                              <div class="input-group">
                                    <button class="btn btn-success" wire:click="add">Add</button>
                               </div>

                        </form>

                    </div>
                </div>
            </div>
        blade;
    }
}
