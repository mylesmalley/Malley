<?php

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\View\View;
use Modules\Labour\Models\UserDay as UD;
use App\Models\User;
use App\Models\Labour;

class LabourAddComponent extends Component
{

    public User $user;
    public Carbon $date;


    public string $job;


    public ?int $start_minutes = null;
    public ?int $start_hours = null;
    public ?int $end_minutes = null;
    public ?int $end_hours = null;
    public string $end_ampm = 'AM';
    public string $start_ampm = 'AM';


    protected array $rules = [
        'job' => 'required|string',
        'start_ampm' => 'required|string|max:2',
        'end_ampm' => 'required|string|max:2',
        'start_hours' => 'required|int|min:1|max:12',
        'start_minutes' => 'required|int|min:0|max:59',
        'end_hours' => 'required|int|min:1|max:12',
        'end_minutes' => 'required|int|min:0|max:59'
    ];

    public $listeners = [
        'addLabourRecord',
        'selectedJob',
        'cancel',
    ];


    public function clear(): void
    {
        unset(
            $this->user,
            $this->date,
        );

        $this->start_minutes = null;
        $this->start_hours = null;
        $this->end_minutes = null;
        $this->end_hours = null;
        $this->end_ampm = 'AM';
        $this->start_ampm = 'AM';
    }


    /**
     * fired when cancel button is clicked
     */
    public function cancel(): void
    {
        $this->clear();
        $this->emit('unlockUserDay' );
    }

    public function selectedJob(array $payload): void
    {
        $this->job = $payload[0];
    }


    public function addLabourRecord(array $payload)
    {
        $this->clear();
        $this->user = User::find($payload['user_id']);
        $this->date = Carbon::parse($payload['date'], 'America/Moncton');
    }

//    /**
//     * listen for if any selected labour record has been deselected for any reason.
//     * Reset the whole component
//     */
//    public function deselectLabourRecord(): void
//    {
//        unset ($this->user);
//        unset ($this->date);
//    }




    public function addLabour()
    {
        $this->validate();

        $newStartString = $this->date->format('Y-m-d') . ' ' .
            $this->start_hours . ":" .
            str_pad( $this->start_minutes, 2, '0', STR_PAD_LEFT )
            . ' ' . $this->start_ampm;


        $newStart = Carbon::parse( $newStartString, 'America/Moncton');

        $newendString = $this->date->format('Y-m-d') . ' ' .
            $this->end_hours . ":" .
            str_pad( $this->end_minutes, 2, '0', STR_PAD_LEFT )
            . ' ' . $this->end_ampm;

        $newEnd = Carbon::parse( $newendString, 'America/Moncton');

//        dd( $this->date->format('Y-m-d')
//        , $newStart->toIso8601String(),  $newEnd->toIso8601String() );

        $lab = Labour::create([
           'user_id' => $this->user->id,
           'department_id' => $this->user->department_id,
           'start' =>  $newStart->toIso8601String(),
            'end' => $newEnd->toIso8601String(),
            'job' => $this->job,
        ]);

   //  dd($lab );
        $lab->save();

        $this->emit('unlockUserDay'); // tell all the user day components to update themselves
        $this->clear();

    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('labour::livewire.labour-add-component');
    }
}
