<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use Illuminate\View\View;
use Livewire\Component;

class Selection extends Component
{

    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.selection');
    }
}