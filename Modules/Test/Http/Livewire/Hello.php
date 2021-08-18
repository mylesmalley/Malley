<?php

namespace Modules\Test\Http\Livewire;

use Livewire\Component;

class Hello extends Component
{
    public string $name = "Myles";


    public function render()
    {
        return view('test::livewire.hello');
    }
}
