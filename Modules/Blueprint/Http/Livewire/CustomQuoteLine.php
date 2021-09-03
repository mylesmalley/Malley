<?php

namespace Modules\Blueprint\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blueprint;
use App\Models\Configuration;

class CustomQuoteLine extends Component
{

    public Blueprint $blueprint;
    public Configuration $configuration;

    /**
     * @var array|string[]
     */
    public array $rules = [
        "configuration.description"   => 'required|max:100',
        "configuration.price_tier_2"  => 'required|numeric',
        "configuration.price_tier_3"  => 'required|numeric',
        "configuration.quantity"      => 'required|integer|min:1',
    ];


    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint ): void
    {
        $this->blueprint = $blueprint;
        $this->configuration = new Configuration();
    }


    /**
     *
     */
    public function save(): void
    {
        $this->validate();
        $this->configuration->fill([
            'blueprint_id' => $this->blueprint->id,
            'base_van_id' => $this->blueprint->base_van_id,
            'value' => 1,
            'show_on_quote' => 1,
            'name' => 'CUSTOM'
        ]);

      //  dd( $this->configuration );

        $this->configuration->save();
        $this->configuration = new Configuration();


        // fire off an event to update the list of configs
        $this->emit( 'reload_quote_body' );
        $this->emit( 'update_totals' );

    }




    public function render(): View
    {
        return view("blueprint::quote.components.custom_line");

    }
}