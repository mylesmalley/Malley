<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Blueprint;
use App\Models\FormElement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Checklist extends Component
{

    public FormElement $element;
    public Blueprint $blueprint;
    public Collection $items;

    public function mount( FormElement $element )
    {
        $this->element = $element;
        $this->items = $this->element->items;
    }

    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.checklist');
    }
}