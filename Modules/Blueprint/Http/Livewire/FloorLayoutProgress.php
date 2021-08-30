<?php

namespace Modules\Blueprint\Http\Livewire;

use App\Models\Wizard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Blueprint;

class FloorLayoutProgress extends Component
{
//
//    public array $progress;
//    public Wizard $wizard;
//    public Blueprint $blueprint;
//    protected $listeners = [ "submittedAnswers" ];

    public function mount()
    {

    }





    public function render()
    {
        return view('blueprint::floor_layout.components.floor_layout_progress');
    }
}
