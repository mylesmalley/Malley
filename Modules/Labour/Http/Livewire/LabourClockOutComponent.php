<?php

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use App\Models\Labour;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\View\View;
use Modules\Labour\Models\UserDay as UD;
use App\Models\User;

class LabourClockOutComponent extends Component
{

    public int $labour_id;
    public Labour $labour;

    public array $listeners = [
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
        $this->labour_id = $payload['id'];
        $this->labour = Labour::find( $payload['id'] );
    }


    public function clock_out()
    {
        if ( $this->labour )
        {
            $this->labour->finish();
        }

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
     * @return View
     */
    public function render(): View
    {
        return view('labour::livewire.labour-clock-out-component');
    }
}
