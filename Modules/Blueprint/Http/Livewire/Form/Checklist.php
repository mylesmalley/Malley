<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;
use Illuminate\View\View;
use  Modules\Blueprint\Http\Livewire\Form\Traits\HasOptionRules;

class Checklist extends Component
{
    use HasOptionRules;

    public FormElement $element;
    public Collection $configurations;


    /**
     * @var array|string[]
     */
    protected array $rules =
    [
        'configurations.*.value' => 'required|boolean',
    ];


    /**
     * turn on or off a config item
     * @param int $index
     */
    public function toggle( int $index ): void
    {
        $this->validate();

        $conf = $this->configurations->get($index);
        $conf->value = ! $conf->value;
        $conf->save();

        $this->emit('update-images');
    }

    /**
     * @param Blueprint $blueprint
     * @param FormElement $element
     */
    public function mount( Blueprint $blueprint, FormElement $element ): void
    {
        $this->element = $element;

        $this->load_rules( $element );

        // grab the form element's options
        $options = $element->items->pluck('option_id');

        // grab the associated config items
        $this->configurations = Configuration::where('blueprint_id', $blueprint->id )
            ->whereIn('option_id', $options )
            ->with('option')
            ->get();

        $this->set_referenced_options( $blueprint->activeOptionNames() );

        $this->check_visibility();
     //   dd( $this->referencedOptions );
       // dd( $this->configurations );
    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::form.components.checklist');
    }
}