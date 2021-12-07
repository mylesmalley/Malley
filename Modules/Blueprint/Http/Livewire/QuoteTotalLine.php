<?php

namespace Modules\Blueprint\Http\Livewire;


use App\Models\Configuration;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blueprint;

class QuoteTotalLine extends Component
{

    public int $padding_columns = 4;
    public Blueprint $blueprint;

    public float $cost;
    public float $dealer;
    public float $msrp;

    public $listeners = [
        'update_totals',
    ];



    /**
     *
     */
    public function update_totals(): void
    {
        $this->cost = 0;
        $this->dealer = 0;
        $this->msrp = 0;

        $configs = Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('obsolete', false)
            ->where('value', 1)
            ->get();;

        $xr = $this->blueprint->exchange_rate;

        foreach( $configs as $c )
        {
            $this->cost += ($c->cost * $xr * $c->quantity);
            $this->dealer += $c->DealerPrice( $this->blueprint->exchange_rate );
            $this->msrp += $c->MSRPPrice( $this->blueprint->exchange_rate );
        }
    }


    /**
     * @param Blueprint $blueprint
     * @param int $padding_columns
     */
    public function mount( Blueprint $blueprint ): void
    {
        $this->blueprint = $blueprint;

        $this->update_totals();
    }



    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_totals");
    }
}
