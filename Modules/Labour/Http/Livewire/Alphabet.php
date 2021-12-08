<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class Alphabet extends Component
{
    public string $letter;

    protected $listeners = [
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
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view("labour::livewire.alphabet");

    }
}
