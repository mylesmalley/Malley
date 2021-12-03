<?php

namespace Modules\Labour\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;

class Alphabet extends Component
{
    public string $letter;

    protected array $listeners = [
        'deselectLetter',
        'hide',
    ];

    protected array $rules = [
        'letter' => 'alpha|max:1',
    ];

    /**
     * save the picked letter and fire off an event for the next component
     * @param string $letter
     */
    public function selectLetter( string $letter ): void
    {
        $this->letter = $letter;
        $this->validate();

        $this->emit('letterSelected', ["letter"=> $letter ] );
    }



    public function hide( array $data ): void
    {
        $this->letter = $data['letter'];
    }


    /**
     * waits for the deselect event and shows the alphabet again.
     */
    public function deselectLetter(): void
    {
        $this->letter = '';
    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view("labour::livewire.alphabet");

    }
}
