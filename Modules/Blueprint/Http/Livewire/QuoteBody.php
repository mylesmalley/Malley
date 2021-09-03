<?php

namespace Modules\Blueprint\Http\Livewire;

use App\Models\Configuration;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\Blueprint;

class QuoteBody extends Component
{

    public Blueprint $blueprint;
    public Collection $configurations;

    public $listeners = [
        'reload_quote_body' //=> '$refresh',
    ];

    public function reload_quote_body()
    {
        $this->configurations = $this->update_configurations();
    }

    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint ): void
    {
        $this->blueprint = $blueprint;

        $this->configurations = $this->update_configurations();
    }

    public function update_configurations()
    {
        return Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('obsolete', false)
            ->where('value', 1)
            ->orderBy('name', 'ASC')
            ->with(['option','option.componentCount'])
            ->get();;
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_body");
    }
}
