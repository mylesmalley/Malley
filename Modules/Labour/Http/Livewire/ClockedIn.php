<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use App\Models\Labour;
use Illuminate\View\View;


class ClockedIn extends Component
{
    public User $user;
    public Labour|null $labour;

    public function mount( User $user )
    {
        $this->user = $user;
        $this->labour = $user->activeLabour();

    }

    public function render(): View
    {
        return view("labour::livewire.clocked-in");
    }
}
