<?php

namespace Modules\Blueprint\Http\Livewire;


use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blueprint;

class QuoteDetails extends Component
{


    public Blueprint $blueprint;


    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint ): void
    {
        $this->blueprint = $blueprint;
    }


    public array $rules = [
        'blueprint.customer_name' => 'string|max:255',
        'blueprint.customer_address_1' => 'string|max:255',
        'blueprint.customer_address_2' => 'string|max:255',
        'blueprint.customer_city' => 'string|max:50',
        'blueprint.customer_province' => 'string|max:20',
        'blueprint.customer_country' => 'string|max:20',
        'blueprint.customer_postalcode' => 'string|max:10',


        'blueprint.exchange_rate' => 'numeric',
        'blueprint.currency' => 'string|max:3',
        'blueprint.quote_number' => 'string|max:20',

        'blueprint.terms' => 'boolean',

    ];

    /**
     *
     */
    public function save(): void
    {
        $this->validate();
        $this->blueprint->save();
        $this->emit('update_totals');
        $this->emit('reload_quote_body');
    }



    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_details");
    }
}
