<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use App\Models\Labour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;

class LabourClockOutComponent extends Component
{

    public int $labour_id;
    public Labour $labour;

    /**
     * @var string[]
     */
    public $listeners = [
        'clockOutLabourRecord',
        'deselectLabourRecord',
        'cancel',

    ];




    /**
     * fired when cancel button is clicked
     */
    public function cancel(): void
    {
        unset( $this->labour );
        unset( $this->labour_id );
        $this->emit('unlockUserDay' );
    }


    public function clockOutLabourRecord( array $payload )
    {
        $this->labour_id = $payload['labour_id'];
        $this->labour = Labour::find( $payload['labour_id'] );
    }


    public function clock_out()
    {
        $this->labour?->finish();

        $this->emit('unlockUserDay'); // tell all the user day components to update themselves

        unset( $this->labour );
        unset( $this->labour_id );
    }


    /**
     * listen for if any selected labour record has been deselected for any reason.
     * Reset the whole component
     */
    public function deselectLabourRecord(): void
    {
        unset ( $this->labour_id );
    }


    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.labour-clock-out-component');
    }
}
