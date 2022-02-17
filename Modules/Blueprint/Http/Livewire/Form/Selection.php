<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\FormElement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\View\View;
use Livewire\Component;

class Selection extends Component
{
    public FormElement $element;

    public function mount( FormElement $element )
    {
        $this->element = $element;
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.selection');
    }
}