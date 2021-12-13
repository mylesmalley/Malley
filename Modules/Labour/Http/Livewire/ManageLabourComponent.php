<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use App\Models\Labour;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Cache;
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
    public ?string $start_minutes;
    public ?string $start_hours;
    public ?string $end_minutes;
    public ?string $end_hours;
    public ?string $end_ampm;
    public ?string $start_ampm;


    protected $rules = [
        'labour.job' => 'sometimes|required|string',
//        'labour.id' => 'sometimes|int',
        'labour.user_id' => 'sometimes|required|int',
        'start_ampm' => 'sometimes|required|string|max:2',
        'end_ampm' => 'sometimes|required|string|max:2',
        'start_hours' => 'sometimes|required|string|max:2',
        'start_minutes' => 'sometimes|required|string|max:2',
        'end_hours' => 'sometimes|required|string|max:2',
        'end_minutes' => 'sometimes|required|string|max:2',
        'labour.department_id' => 'sometimes|required|int',
    ];


    /**
     * @var string[]
     */
    public $listeners = [
        'manageTime',
        'cancelManageTime',
        'addTime' => 'add_time',
        'selected_job',
    ];


    /**
     * clear out the component when an action is done so that it doesn't pollute the next one
     * fires off cancel_selected_record event to clear the user-days component of selections
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
        $this->emit('cancel_selected_record');
    }


    /**
     * listens for the add_time event and then builds up a new labour
     * model. starts filling in what it can
     *
     * @param array $event_payload
     */
    public function add_time(array $event_payload)
    {
        $this->labour = new Labour;
        $this->user = User::find($event_payload['user_id']);
        $this->labour->user_id = $this->user->id;
        $this->labour->department_id = $this->user->department_id;
        $this->date = Carbon::parse($event_payload['date'], "America/Moncton");

        // initialize the handling of chunks of time.
        $time = Carbon::now("America/Moncton");

        $this->start_hours = $time->copy()->subHour()->format('g');
        $this->end_hours = $time->format('g');
        $this->start_minutes = '00';
        $this->end_minutes = '00';
        $this->start_ampm = $time->format('A');
        $this->end_ampm = $time->copy()->subHour()->format('A');
    }


    /**
     * saves the labour model created, after validating first.
     */
    public function save_new_labour(): void
    {
        $this->validate();


        // flip around the values if the end is before the beginning
        $first_date = $this->parse_time_chunks($this->date, 'start');
        $second_date = $this->parse_time_chunks($this->date, 'end');

        $start = $first_date->lessThan($second_date) ? $first_date : $second_date;
        $end = $second_date->greaterThan($first_date) ? $second_date : $first_date;

        $this->labour->fill([
            'user_id' => $this->user->id,
            'start' => $start,
            'end' => $end,
        ]);

        // for some reason laravel is adding an id column, even though it's empty
        unset($this->labour->id);
        $this->labour->save();

        // housekeeping
        Log::info("Saved new labour record " . $this->labour->id);
        Cache::forget('_user_day_' . $this->user->id . '-' . $this->date->format('Y-m-d'));

        $this->emit('refresh_user_day');
        $this->cancelManageTime();
    }

    /**
     * listens for the selected_job event and updates the model
     * @param array $payload
     */
    public function selected_job(array $payload): void
    {
        $this->labour->job = $payload[0];
    }


    /**
     * initializes the component when a labour id is provided.
     *
     * @param array $event_payload
     */
    public function manageTime(array $event_payload)
    {
        $record = Labour::with('user')
            ->where('id', '=', $event_payload['labour_id'])
            ->first();

        $this->labour = $record;
        $this->user = $record->user;
        $this->clocked_in = $record->getOriginal('end') === null;

        $start = Carbon::parse($this->labour->start);

        $this->start_hours = $start->format('g');
        $this->start_minutes = $start->format('i');
        $this->start_ampm = $start->format('A');

        $end = Carbon::parse($this->labour->end);

        $this->end_hours = $end->format('g');
        $this->end_minutes = $end->format('i');
        $this->end_ampm = $end->format('A');

    }


    /**
     * save changes to a finished record.
     */
    public function update_record(): void
    {
        $this->validate();

        // flip around the values if the end is before the beginning
        $first_date = $this->parse_time_chunks($this->labour->start, 'start');
        $second_date = $this->parse_time_chunks($this->labour->start, 'end');

        $start = $first_date->lessThan($second_date) ? $first_date : $second_date;
        $end = $second_date->greaterThan($first_date) ? $second_date : $first_date;


        $this->labour->update([
            'department_id' => $this->labour->department_id,
            'start' => $start,
            'end' => $end,
            'flagged' => false, // if you are saving it, it shouldn't be flagged as a problem anymore
            'job' => $this->labour->job,
        ]);

        Log::info("Updated labour record " . $this->labour->id);
        $this->emit('refresh_user_day');
        Cache::forget('_user_day_' . $this->user->id . '-' . $this->labour->start->format('Y-m-d'));
        $this->cancelManageTime();
    }


    /**
     * an active labour record needs to be clocked out before you can edit or delete it
     */
    public function clock_out(): void
    {
        $this->labour?->finish();
        $this->emit('refresh_user_day');
        Log::info("Manually clocked out " . $this->labour->id);
        Cache::forget('_user_day_' . $this->user->id . '-' . $this->date->format('Y-m-d'));
        $this->cancelManageTime();
    }


    /**
     * Takes the chunks of time from the form and parses them into a carbon instance
     *
     * @param Carbon $date
     * @param string $prefix
     * @return Carbon
     */
    private function parse_time_chunks(Carbon $date, string $prefix): Carbon
    {
        $newEndString = $date->format('Y-m-d') . ' ' .
            $this->{$prefix . "_hours"} . ":" .
            str_pad($this->{$prefix . "_minutes"}, 2, '0', STR_PAD_LEFT)
            . ' ' . $this->{$prefix . "_ampm"};

        return Carbon::parse($newEndString, 'America/Moncton');
    }


    public function delete_labour_record()
    {
        Log::info("deleted labour ". $this->labour->id );
        Cache::forget('_user_day_' . $this->user->id . '-' . $this->labour->start->format('Y-m-d'));
        Labour::where('id', '=', $this->labour->id)
            ->delete();

        $this->emit('refresh_user_day');
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
