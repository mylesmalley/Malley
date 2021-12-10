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
    public ?bool $clocked_in; // clocked in or out


    // chunks of time for editing...
    public ?int $start_minutes;
    public ?int $start_hours;
    public ?int $end_minutes;
    public ?int $end_hours;
    public ?string $end_ampm;
    public ?string $start_ampm;



    public $rules = [
        'job' => 'sometimes|string',
        'start_ampm' => 'sometimes|string|max:2',
        'end_ampm' => 'sometimes|string|max:2',
        'start_hours' => 'sometimes|int|min:1|max:12',
        'start_minutes' => 'sometimes|int|min:0|max:59',
        'end_hours' => 'sometimes|int|min:1|max:12',
        'end_minutes' => 'sometimes|int|min:0|max:59',
        'department_id' => 'sometimes|int',
    ];


    /**
     * @var string[]
     */
    public $listeners = [
        'manageTime',
        'cancelManageTime',
    ];


    public function cancelManageTime()
    {
        unset( $this->labour );
        unset( $this->user );
        unset( $this->clocked_in );
    }


    /**
     * @param array $event_payload
     */
    public function manageTime( array $event_payload )
    {
        $record = Labour::with('user')
            ->where('id', '=', $event_payload['labour_id'])
            ->first();

        $this->labour = $record;
        $this->user = $record->user;
        $this->clocked_in = $record->getOriginal('end') === null;




        $start = Carbon::parse( $this->labour->start );

        $this->start_hours = $start->format('g');
        $this->start_minutes = $start->format('i');
        $this->start_ampm = $start->format('A');

        $end = Carbon::parse( $this->labour->end );

        $this->end_hours = $end->format('g');
        $this->end_minutes = $end->format('i');
        $this->end_ampm = $end->format('A');

//        $this->department_id = $this->labour->department_id;
//        $this->job = $this->labour->job;


    }



    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.manage-labour');
    }
}
