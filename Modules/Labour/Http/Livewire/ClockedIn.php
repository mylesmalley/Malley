<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use App\Models\User;
use App\Models\Labour;


class ClockedIn extends Component
{
    public User $user;
    public Labour|null $labour;

    public function mount( User $user )
    {
        $this->user = $user;
        $this->labour = $user->activeLabour();

    }

    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view("labour::livewire.clocked-in");
    }
}
