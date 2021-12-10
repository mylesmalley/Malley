<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use App\Models\Labour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
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


    protected $rules = [
        'labour.job' => 'sometimes|string',
        'labour.id' => 'sometimes|int',
        'start_ampm' => 'sometimes|string|max:2',
        'end_ampm' => 'sometimes|string|max:2',
        'start_hours' => 'sometimes|int|min:1|max:12',
        'start_minutes' => 'sometimes|int|min:0|max:59',
        'end_hours' => 'sometimes|int|min:1|max:12',
        'end_minutes' => 'sometimes|int|min:0|max:59',
        'labour.department_id' => 'sometimes|int',
    ];


    /**
     * @var string[]
     */
    public $listeners = [
        'manageTime',
        'cancelManageTime',
        'addTime'
    ];


    /**
     * clear out the component when an action is done so that it doesn't pollute the next one
     */
    public function cancelManageTime()
    {
        unset(
            $this->labour,
            $this->user,
            $this->clocked_in,
            $this->date,
            $this->start_ampm,
            $this->end_ampm,
            $this->start_hours,
            $this->end_hours,
            $this->start_minutes,
            $this->end_minutes,
        );
    }



    /**
     * @param array $event_payload
     */
    public function addTime( array $event_payload )
    {
        $this->labour = new Labour;
        $this->user = User::find($event_payload['user_id']);

        $this->labour->user_id = $event_payload['user_id'];
        $this->labour->department_id = $this->user->department_id;

        $this->date = Carbon::parse( $event_payload['date'],"America/Moncton" );

        $time = Carbon::now("America/Moncton");


        $this->start_hours = $time->copy()->subHour()->format('g');
        $this->end_hours = $time->format('g');
        $this->start_minutes = '00';
        $this->end_minutes = '00';
        $this->start_ampm = $time->format('A');
        $this->end_ampm = $time->copy()->subHour()->format('A');




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

    }


    /**
     *
     */
    public function update_record(): void
    {
        $this->validate();

        $newStartString = $this->labour->start->format('Y-m-d') . ' ' .
            $this->start_hours . ":" .
            str_pad( $this->start_minutes, 2, '0', STR_PAD_LEFT )
            . ' ' . $this->start_ampm;

        $newStart = Carbon::parse( $newStartString, 'America/Moncton');

        $newEndString = $this->labour->start->format('Y-m-d') . ' ' .
            $this->end_hours . ":" .
            str_pad( $this->end_minutes, 2, '0', STR_PAD_LEFT )
            . ' ' . $this->end_ampm;

        $newEnd = Carbon::parse( $newEndString, 'America/Moncton');

        $this->labour->update([
            'department_id' => $this->labour->department_id,
            'start' =>  $newStart->toIso8601String(),
            'end' => $newEnd->toIso8601String(),
            'flagged' => false, // if you are saving it, it shouldn't be flagged as a problem anymore
            'job' => $this->labour->job,
        ]);

        Log::info( "Updated labour record ". $this->labour->id );
        $this->emit('refresh_user_day');

        $this->cancelManageTime();
    }


    /**
     *
     */
    public function clock_out(): void
    {
        $this->labour?->finish();
        $this->emit('refresh_user_day');
        Log::info( "Manually clocked out ". $this->labour->id );
        $this->cancelManageTime();
    }








    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.manage-labour');
    }
}
