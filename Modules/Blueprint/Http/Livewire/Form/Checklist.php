<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\FormElement;
use App\Models\Wizard;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;

class Checklist extends Component
{

    public FormElement $element;

    /**
     * @param FormElement $element
     */
    public function mount( FormElement $element )
    {
        $this->element = $element;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.checklist');
    }
}