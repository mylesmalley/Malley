<?php

namespace Modules\Blueprint\Http\Livewire;


use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blueprint;

class QuoteDetails extends Component
{



    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint ): void
    {

    }



    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_details");
    }
}
