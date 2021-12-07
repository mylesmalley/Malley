<?php

namespace Modules\Blueprint\Http\Livewire;

use App\Models\Configuration;
use Illuminate\View\View;
use Illuminate\Support\Collection;
use Livewire\Component;
use App\Models\Blueprint;

class QuoteBody extends Component
{

    public Blueprint $blueprint;
    public Collection $configurations;
    public bool $showAllOptions ;

    public $listeners = [
        'reload_quote_body' //=> '$refresh',
    ];

    /**
     *
     */
    public function reload_quote_body(): void
    {
        $this->configurations = $this->update_configurations();
    }

    /**
     * @param Blueprint $blueprint
     */
    public function mount( Blueprint $blueprint ): void
    {
        $this->blueprint = $blueprint;
        $this->showAllOptions = false;
        $this->configurations = $this->update_configurations();
    }


    /**
     *
     */
    public function showAllOptions(): void
    {
        $this->showAllOptions = ! $this->showAllOptions;
        $this->configurations = $this->update_configurations();

    }

    /**
     * @return Collection
     */
    public function update_configurations(): Collection
    {
        return Configuration::where('blueprint_id', $this->blueprint->id )
            ->where('obsolete', false)
            ->when( ! $this->showAllOptions, function( $query ){
                return $query->where('value', 1);
                   // ->where('name', 'not like', '%-Z9%');
            })
            ->orderBy('name', 'ASC')
            ->with(['option','option.componentCount','blueprint'])
            ->get();
    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view("blueprint::quote.components.quote_body");
    }
}
