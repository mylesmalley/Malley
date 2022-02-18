<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Livewire\Component;
use Modules\Blueprint\Http\Livewire\Form\Traits\HasOptionRules;

class Checklist extends Component
{
    use HasOptionRules;

    public FormElement $element;
    public Collection $items;
    public array $configuration;


    public $listeners = [
        'update-configuration' => 'updatedConfiguration'
    ];





    public function mount( FormElement $element, array $configuration )
    {
//        Log::info("Mounted element $element->id");

        $this->element = $element;
        $this->items = $this->element->items;
        $this->configuration = $configuration;

        $this->load_rules( $this->element );
        $this->set_referenced_options( $this->configuration  );
        $this->check_visibility();
    }



    /**
     * @param Configuration $configuration
     */
    public function toggle( Configuration $configuration ): void
    {
        $configuration->update([
            'value' => ! $configuration->value,
        ]);

        $this->configuration[ $configuration->option_id ]['value'] = ! $this->configuration[ $configuration->option_id ]['value'] ;
//        Log::info("Clicked on ".$configuration->id);

        $this->emit('update-form');
        $this->emit('update-images');
    }


    /**
     * @return Application|Factory|\Illuminate\Contracts\View\View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.checklist');
    }
}