<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\FormElement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Livewire\Component;

class Selection extends Component
{
    public FormElement $element;
    public Collection $items;
    public array $configuration;

    public function mount( FormElement $element, array $configuration )
    {
        $this->element = $element;
        $this->items = $this->element->items;
        $this->configuration = $configuration;
    }


    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.selection');
    }
}