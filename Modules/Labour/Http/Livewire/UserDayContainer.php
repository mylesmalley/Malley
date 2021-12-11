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

    public array $users;
    public array $dates;

    public ?string $selectedDate;
    public ?int $selectedUser;

    public $listeners = [
//        'loadData',
//        'lockUserDay',
        'refresh_user_day',
    ];



    /**
     * @param array $user_ids
     * @param array $dates
     */
    public function mount( array $user_ids = [], array $dates = [] ): void
    {
   //     $this->payload = $eventPayload ?? $this->payload;

        $this->users = $user_ids;
        $this->dates = $dates;

        $userDays = [];
        foreach($user_ids as $user )
        {
            foreach( $dates as $date )
            {
                $userDays[] = UserDay::get( $user, $date );
            }
        }

        //dd( $userDays);
        $this->userDays = $userDays;
    }




    /**
     * @param int $labour_id
     */
    public function manageTime( int $labour_id ): void
    {
        unset( $this->selectedDate );
        unset( $this->selectedUser );

        $this->selectedRow = $labour_id;

        $this->emit('manageTime',  [
            'labour_id' => $labour_id,
        ]);
    }



    public function refresh_user_day(): void
    {
        unset( $this->selectedDate );
        unset( $this->selectedRow );
        unset( $this->selectedUser );

        $this->mount( $this->users, $this->dates );
        $this->locked = false;
        unset(
            $this->adding_row_indicator,
            $this->adding_row_user_indicator,
            $this->selectedRow
        );
    }



    /**
     * @param string $date
     * @param int $user_id
     */
    public function addTime( string $date, int $user_id  ): void
    {
        unset( $this->selectedRow );

        $this->selectedDate = $date;
        $this->selectedUser = $user_id;

        $this->emit('addTime',  [
            'user_id' => $user_id,
            'date' => $date,
        ]);
    }



    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.user-day-container' );
    }
}
