<?php

namespace Modules\Blueprint\Http\Livewire;


use Livewire\Component;
use Illuminate\View\View;
use App\Models\Configuration;

class ConfigurationLine extends Component
{

    public Configuration $configuration;

    /**
     * @param Configuration $configuration
     */
    public function mount(Configuration $configuration): void
    {
        $this->configuration = $configuration;
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
