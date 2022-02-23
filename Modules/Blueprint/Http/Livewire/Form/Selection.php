<?php

namespace Modules\Blueprint\Http\Livewire\Form;

use App\Models\Configuration;
use App\Models\FormElement;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\Contracts\View\View;
use Modules\Blueprint\Http\Livewire\Form\Traits\HasOptionRules;


class Selection extends Component
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
        $this->element = $element;
        $this->items = $this->element->items;
        $this->configuration = $configuration;

        $this->get_referenced_options();

//        Log::info("Mounted element $element->id");


//        $this->load_rules( $this->element );
//        $this->set_referenced_options( $this->configuration  );
//        $this->check_visibility();
//        $this->referenced_option_names = array_merge( $this->referenced_option_names, $this->referencedOptions );

    }


    /**
     * @param Configuration $configuration
     */
    public function toggle( Configuration $configuration ): void
    {

        $option_ids = $this->items->pluck('option_id')
            ->toArray();
        $config_ids = [];

        foreach($option_ids as $opt)
        {
            // grab the target config id item
            $config_ids[] = $this->configuration[$opt]['id'];
            // for the form, change the local configuration to be turned off so that it looks right but isn't actually changed in the DB
            $this->configuration[$opt]['value'] = 0;
        }

        // actually turn off the options in the set
        Configuration::whereIn('id', $config_ids)
            ->update([
                'value' => 0,
            ]);

        // turn on the selected option in the database
        $configuration->update([
            'value' => 1
        ]);

        // update the form view to show the one we want selected to bring it in line with the database.
        $this->configuration[$configuration->option_id]['value'] = 1;

        $this->emit("update-configuration", $configuration->name );
//
//        $this->emit('update-form');
//        $this->emit('update-images');
    }




    /**
     * @return Application|Factory|View
     */
    public function render(): Application|Factory|View
    {
        return view('blueprint::form.components.selection');
    }
}