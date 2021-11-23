<?php

namespace Modules\Index\Http\Livewire;


use Illuminate\Support\Facades\Log;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Option;
use Modules\Index\Jobs\CreateOptionRevision;
use PHPUnit\Exception;

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
        "option.option_price_tier_2"           => 'required|numeric',
        "option.option_price_tier_3"           => 'required|numeric',
        "option.option_price_dealer_offset"    => 'numeric',
        "option.option_price_msrp_offset"      => 'numeric',
    ];


    public function toggle_status()
    {
        $this->active = !$this->active;
    }


    /**
     *
     */
    public function save(): void
    {
        $this->validate();

        try {
            CreateOptionRevision::dispatch( $this->option );
        } catch( \Exception $e )
        {
            Log::error( $e );
        }


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
