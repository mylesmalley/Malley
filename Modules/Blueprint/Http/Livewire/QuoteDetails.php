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
        'blueprint.customer_name' => 'nullable|string|max:255',
        'blueprint.customer_address_1' => 'nullable|string|max:255',
        'blueprint.customer_address_2' => 'nullable|string|max:255',
        'blueprint.customer_city' => 'nullable|string|max:50',
        'blueprint.customer_province' => 'nullable|string|max:20',
        'blueprint.customer_country' => 'nullable|string|max:20',
        'blueprint.customer_postalcode' => 'nullable|string|max:10',


        'blueprint.exchange_rate' => 'numeric',
        'blueprint.currency' => 'nullable|string|max:3',
        'blueprint.quote_number' => 'nullable|string|max:20',

        'blueprint.terms' => 'nullable|boolean',

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
