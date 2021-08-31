<?php

namespace Modules\Blueprint\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blueprint;

class QuoteTotalLine extends Component
{

    public int $padding_columns = 3;
    public Blueprint $blueprint;

    public float $cost;
    public float $dealer;
    public float $msrp;


    /**
     *
     */
    public function update(): void
    {
        $this->cost = 0;
        $this->dealer = 0;
        $this->msrp = 0;

        $configs = DB::table('configurations')
            ->where('blueprint_id', $this->blueprint->id )
            ->where('value', 1)
            ->select(['id', 'cost', 'quantity', 'value', 'price_tier_2', 'price_tier_3'])
            ->get();

        $xr = $this->blueprint->exchange_rate;

        foreach( $configs as $c )
        {
            $this->cost += ($c->cost * $xr * $c->quantity);
            $this->dealer += ($c->price_tier_2 * $xr * $c->quantity);
            $this->msrp += ($c->price_tier_3 * $xr * $c->quantity);
        }
    }


    /**
     * @param Blueprint $blueprint
     * @param int $padding_columns
     */
    public function mount( Blueprint $blueprint, int $padding_columns = 3): void
    {
        $this->padding_columns = $padding_columns;
        $this->blueprint = $blueprint;

        $this->update();
    }



    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_totals");
    }
}
