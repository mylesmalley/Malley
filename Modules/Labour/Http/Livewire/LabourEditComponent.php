<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use App\Models\Labour;
use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Livewire\Component;


class LabourEditComponent extends Component
{

    public int $labour_id;
    public Labour $labour;

    public ?int $start_minutes = null;
    public ?int $start_hours = null;
    public ?int $end_minutes = null;
    public ?int $end_hours = null;
    public string $end_ampm;
    public string $start_ampm;

    public int $department_id;
    public string $job;


    public $listeners = [
        'editLabourRecord',
        'deselectLabourRecord',
        'selectedJob',
        'cancel',
    ];


    protected array $rules = [
        'job' => 'required|string',
        'start_ampm' => 'required|string|max:2',
        'end_ampm' => 'required|string|max:2',
        'start_hours' => 'required|int|min:1|max:12',
        'start_minutes' => 'required|int|min:0|max:59',
        'end_hours' => 'required|int|min:1|max:12',
        'end_minutes' => 'required|int|min:0|max:59',
        'department_id' => 'required|int',
    ];


    /**
     * fired when cancel button is clicked
     */
    public function cancel(): void
    {
        unset( $this->labour_id );
        unset( $this->labour );
        $this->emit('unlockUserDay' );
    }


    /**
     * when a row is selected, this
     *
     * @param array $payload
     */
    public function editLabourRecord( array $payload )
    {
        $this->labour_id = $payload['id'];
        $this->labour = Labour::find( $payload['id'] );

        $start = Carbon::parse( $this->labour->start );

        $this->start_hours = $start->format('g');
        $this->start_minutes = $start->format('i');
        $this->start_ampm = $start->format('A');

        $end = Carbon::parse( $this->labour->end );

        $this->end_hours = $end->format('g');
        $this->end_minutes = $end->format('i');
        $this->end_ampm = $end->format('A');

        $this->department_id = $this->labour->department_id;
        $this->job = $this->labour->job;


    }


    public function submitForm()
    {
        $this->validate();

        $newStartString = $this->labour->start->format('Y-m-d') . ' ' .
            $this->start_hours . ":" .
            str_pad( $this->start_minutes, 2, '0', STR_PAD_LEFT )
            . ' ' . $this->start_ampm;

        $newStart = Carbon::parse( $newStartString, 'America/Moncton');

        $newendString = $this->labour->start->format('Y-m-d') . ' ' .
            $this->end_hours . ":" .
            str_pad( $this->end_minutes, 2, '0', STR_PAD_LEFT )
            . ' ' . $this->end_ampm;

        $newEnd = Carbon::parse( $newendString, 'America/Moncton');


//        dd( $this->date->format('Y-m-d')
//        , $newStart->toIso8601String(),  $newEnd->toIso8601String() );

        $this->labour->update([
            'department_id' => $this->department_id,
            'start' =>  $newStart->toIso8601String(),
            'end' => $newEnd->toIso8601String(),
            'job' => $this->job,
        ]);

      //  $lab->save();

        $this->emit('unlockUserDay'); // tell all the user day components to update themselves

        unset( $this->labour );
        unset( $this->labour_id );
        // dd( $lab->save() );
    }


    public function selectedJob(array $payload): void
    {
        $this->job = $payload[0];
    }



    public function deleteLabourRecord()
    {
        $this->labour->delete();

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
        unset ( $this->labour );
    }



    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.labour-edit-component');
    }
}
