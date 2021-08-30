<?php

namespace Modules\Blueprint\Http\Livewire;


use Livewire\Component;
use Illuminate\View\View;
use App\Models\Configuration;

class ConfigurationLine extends Component
{

    public Configuration $configuration;
    public bool $details = false;
    public bool $pricing = false;

    /**
     * @param Configuration $configuration
     */
    public function mount(Configuration $configuration, bool $pricing = false): void
    {
        $this->pricing = $pricing;
        $this->configuration = $configuration;
    }


    /**
     * toggles if teh detail view is on or not
     */
    public function details(): void
    {
        $this->details = ! $this->details;
    }

    public function toggle()
    {
        $this->configuration->value = ! $this->configuration->value;
        $this->configuration->save();
    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view('blueprint::configuration.line');
    }
}
