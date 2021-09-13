<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use App\Models\Wizard;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;

class Checklist extends Component
{

    public FormElement $element;
    public Collection $configurations;


    protected array $rules =
    [
        'configurations.*.value' => 'required|boolean',
    ];


    public function toggle( int $index )
    {
        $this->validate();

        $conf = $this->configurations->get($index);
            $conf->value = ! $conf->value;
            $conf->save();
    }

    /**
     * @param Blueprint $blueprint
     * @param FormElement $element
     */
    public function mount( Blueprint $blueprint, FormElement $element )
    {
        $this->element = $element;

        // grab the form element's options
        $options = $element->items->pluck('option_id');

        // grab the associated config items
        $this->configurations = Configuration::where('blueprint_id', $blueprint->id )
            ->whereIn('option_id', $options )
            ->with('option')
            ->get();

    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.checklist');
    }
}