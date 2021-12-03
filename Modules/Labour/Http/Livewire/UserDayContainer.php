<?php

namespace Modules\Labour\Http\Livewire;

use Livewire\Component;
use Illuminate\View\View;
use Modules\Labour\Models\UserDay;

class UserDayContainer extends Component
{

    public array $userDays = [];
    public bool $locked = false;
    public int $selectedRow;


    public bool $adding_row_indicator;
    public string $adding_row_user_indicator;

    public ?array $payload;

    public array $listeners = [
        'loadData',
        'lockUserDay',
        'unlockUserDay',
    ];


    public function loadData( array $eventPayload = null )
    {
        $this->payload = $eventPayload ?? $this->payload;

        $userDays = [];
        foreach($this->payload['users'] as $user )
        {
            foreach( $this->payload['dates'] as $date )
            {
                $userDays[] = UserDay::get( $user, $date );
            }
        }

        $this->userDays = $userDays;
    }





    /* START */

    public function lockUserDay(): void
    {
        $this->locked = true;
    }

    public function unlockUserDay(): void
    {
        $this->loadData();
        $this->locked = false;
        unset(
            $this->adding_row_indicator,
            $this->adding_row_user_indicator,
            $this->selectedRow
        );
    }


    public function clockOutRow( int $labour_id, ): void
    {
        $this->lockUserDay();
        $this->selectedRow = $labour_id;
        $this->emit('clockOutLabourRecord',  [
            'labour_id' => $labour_id,
        ]);
    }

    public function editRow( int $labour_id ): void
    {
        $this->lockUserDay();
        $this->selectedRow = $labour_id;
        $this->emit('editLabourRecord',  [
            'id' => $labour_id
        ]);
    }

    public function addRow( string $date, int $user_id  ): void
    {
        $this->lockUserDay();
        $this->adding_row_indicator = true;
        $this->adding_row_user_indicator = $user_id.$date;
        $this->emit('addLabourRecord',  [
            'user_id' => $user_id,
            'date' => $date,
        ]);
    }
    /* END */











    /**
     * @return View
     */
    public function render(): View
    {
        return view('labour::livewire.user-day-container' );
    }
}
