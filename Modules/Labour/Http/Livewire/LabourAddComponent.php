<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;
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


    /**
     * Listens for when the addLabourRecord event is fired
     * clears the form of any contents, then updates based on the date and time provided.
     *
     * @param array $payload
     */
    public function addLabourRecord(array $payload)
    {
        $this->clear();
        $this->user = User::find($payload['user_id']);
        $this->date = Carbon::parse($payload['date'], 'America/Moncton');
    }

    /**
     *  resets the form whenever a new user or date is chosen or when the function is cleared.
     */
    public function clear(): void
    {
        unset(
            $this->user,
            $this->date,
        );

//        $time = Carbon::now("America/Moncton");
//
//        $this->start_minutes = '00';
//        $this->start_hours = $time->copy()->subHour()->format('g');
//        $this->end_minutes = '00';
//        $this->end_hours = $time->format('g');
//        $this->end_ampm = $time->copy()->subHour()->format('A');
//        $this->start_ampm = $time->format('A');
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






//
//
//    public function addLabour()
//    {
//        $this->validate();
//
//        $newStartString = $this->date->format('Y-m-d') . ' ' .
//            $this->start_hours . ":" .
//            str_pad( $this->start_minutes, 2, '0', STR_PAD_LEFT )
//            . ' ' . $this->start_ampm;
//
//
//        $newStart = Carbon::parse( $newStartString, 'America/Moncton');
//
//        $newendString = $this->date->format('Y-m-d') . ' ' .
//            $this->end_hours . ":" .
//            str_pad( $this->end_minutes, 2, '0', STR_PAD_LEFT )
//            . ' ' . $this->end_ampm;
//
//        $newEnd = Carbon::parse( $newendString, 'America/Moncton');
//
////        dd( $this->date->format('Y-m-d')
////        , $newStart->toIso8601String(),  $newEnd->toIso8601String() );
//
//        $lab = Labour::create([
//           'user_id' => $this->user->id,
//           'department_id' => $this->user->department_id,
//           'start' =>  $newStart->toIso8601String(),
//            'end' => $newEnd->toIso8601String(),
//            'job' => $this->job,
//        ]);
//
//   //  dd($lab );
//        $lab->save();
//
//        $this->emit('unlockUserDay'); // tell all the user day components to update themselves
//        $this->clear();
//
//    }

    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.labour-add-component');
    }
}
