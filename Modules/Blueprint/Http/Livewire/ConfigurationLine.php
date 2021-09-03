<?php

namespace Modules\Blueprint\Http\Livewire;


use Livewire\Component;
use Illuminate\View\View;
use App\Models\Configuration;

class ConfigurationLine extends Component
{

    public Configuration $configuration;
    public bool $details = false;
    public bool $pricing = false;
    public float $exchange_rate;
    public string $currency = "CAD";

    /**
     * @param Configuration $configuration
     */
    public function mount(Configuration $configuration, bool $pricing = false): void
    {
        $this->pricing = $pricing;
        $this->configuration = $configuration;
        $this->exchange_rate = $configuration->blueprint->exchange_rate;
        $this->currency = $configuration->blueprint->currency;
    }


    public array $rules = [
        'configuration.value' => 'sometimes|boolean',
        'configuration.show_on_quote' => 'sometimes|boolean',
        'configuration.lock_pricing' => 'sometimes|boolean',

        'configuration.quantity' => 'required|integer|min:1',
        'configuration.price_tier_2' => 'required|numeric',
        'configuration.price_tier_3' => 'required|numeric',
        'configuration.price_dealer_offset' => 'sometimes|numeric',
        'configuration.price_msrp_offset' => 'sometimes|numeric',
    ];


    /**
     * toggles if teh detail view is on or not
     */
    public function details(): void
    {
        $this->details = ! $this->details;
    }


    /**
     * push the changes necessary
     */
    public function save(): void
    {
        $this->validate();
        $this->configuration->save();
        $this->emit('update_totals');
    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::configuration.line');
    }
}
