<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use App\Models\Labour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Carbon\Carbon;
use App\Models\User;

class ManageLabourComponent extends Component
{

    public ?Labour $labour;
    public ?User $user;
    public ?Carbon $date;
    public bool $visible = false;


    /**
     * @var string[]
     */
    public $listeners = [
        'manageTime'
    ];


    public function manageTime( array $event_payload )
    {
     //   $this->resetExcept([]);

        $this->labour = Labour::with('user')
                            ->where('id', '=', $event_payload['labour_id'])
                            ->first();

        $this->visible = true;
    }



    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.manage-labour');
    }
}
