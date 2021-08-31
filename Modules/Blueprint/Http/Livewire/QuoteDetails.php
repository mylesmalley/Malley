<?php

namespace Modules\Blueprint\Http\Livewire;


use Illuminate\Support\Facades\DB;
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
    ];

    /**
     *
     */
    public function save(): void
    {
        $this->validate();
        $this->blueprint->save();
    }



    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_details");
    }
}
