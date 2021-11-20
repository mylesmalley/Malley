<?php

namespace Modules\Index\Http\Livewire;


use Livewire\Component;
use Illuminate\View\View;
use App\Models\Option;

class OptionPricing extends Component
{


    public Option $option;
    public bool $active = false;


    /**
     * @param Option $option
     */
    public function mount( Option $option ): void
    {
        $this->option = $option;
    }


    public array $rules = [
        "option_price_tier_2"           => 'required|numeric',
        "option_price_tier_3"           => 'required|numeric',
        "option_price_dealer_offset"    => 'numeric',
        "option_price_msrp_offset"      => 'numeric',
    ];

    /**
     *
     */
    public function save(): void
    {
        $this->validate();

        dd("save");
    //    $this->option->save();
      //  $this->emit('update_totals');
        //$this->emit('reload_quote_body');
    }



    public function render()
    {
        return view("index::index.pricing.option_pricing_component");
    }
}
