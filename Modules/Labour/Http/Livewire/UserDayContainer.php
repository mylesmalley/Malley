<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
use Modules\Labour\Models\UserDay;

class UserDayContainer extends Component
{

    public array $userDays = [];
    public bool $locked = false;
    public int $selectedRow;


    public bool $adding_row_indicator;
    public string $adding_row_user_indicator;

    public ?array $payload;

    public $listeners = [
        'loadData',
        'lockUserDay',
        'unlockUserDay',
    ];


    /**
     * @param array|null $eventPayload
     */
    public function loadData( array $eventPayload = null ): void
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


    /**
     * @param int $labour_id
     */
    public function manageTime( int $labour_id ): void
    {
        $this->emit('manageTime',  [
            'labour_id' => $labour_id,
        ]);
    }



    /* START */

    public function lockUserDay(): void
    {
        $this->locked = true;
       // $this->emit('cancel');
    }

    public function unlockUserDay(): void
    {
//        $this->emit('cancel');


        $this->loadData();
        $this->locked = false;
        unset(
            $this->adding_row_indicator,
            $this->adding_row_user_indicator,
            $this->selectedRow
        );
    }


    /**
     * @param int $labour_id
     */
    public function clockOutRow( int $labour_id ): void
    {


        $this->lockUserDay();
        $this->selectedRow = $labour_id;

        $this->emit('clockOutLabourRecord',  [
            'labour_id' => $labour_id,
        ]);
    }

    /**
     * @param int $labour_id
     */
    public function editRow( int $labour_id ): void
    {

        $this->lockUserDay();
        $this->selectedRow = $labour_id;
        $this->emit('editLabourRecord',  [
            'id' => $labour_id
        ]);
    }


    /**
     * @param string $date
     * @param int $user_id
     */
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
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.user-day-container' );
    }
}
