<?php

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Illuminate\View\View;
use App\Models\User;


class LabourManagementUserFilterComponent extends Component
{
    public string $activeTab;
    public int $department_id;
    public string $by_department_date;
    public string $all_staff_date;

    public int $by_person_user_id;
    public string $by_person_end_date;
    public string $by_person_start_date;


    protected array $rules = [
        'department_id' => 'integer',
        'by_department_date' => 'string',
        'all_staff_date' => 'date',
        'by_person_user_id' => 'integer',
        'by_person_end_date' => 'date',
        'by_person_start_date' => 'date',
    ];


    /**
     *
     */
    public function mount(): void
    {
        $today =  Carbon::today()->format('Y-m-d');
        $yesterday =  Carbon::yesterday()->format('Y-m-d');

        // default tab
        $this->activeTab = session('labour_management_active_tab') ?? 'hello';

        // all staff
        $this->all_staff_date = session('selected_all_staff_date') ?? $today;

        // by department by date
        $this->by_department_date = session('selected_department_date') ?? $today;
        $this->department_id = session('selected_department_id') ?? 1;

        // by person by date defaults
        $this->by_person_user_id = session('by_person_user_id') ?? Auth::user()->id;
        $this->by_person_end_date = session('by_person_end_date') ?? $today;
        $this->by_person_start_date = session('by_person_start_date') ?? $yesterday;

    }


    public function allStaffByDate(): void
    {
        $this->validate();

        session([ 'all_staff_date' => $this->all_staff_date ]);

        $this->emit('cancel' );

        $this->emit('loadData', [
            'users' => User::role('labour')
                ->where('is_enabled', true )
                ->orderBy('last_name')
                ->pluck('id')
                ->toArray(),
            'dates' => [ $this->all_staff_date ]
        ]);

    }




    public function byPersonByDateRange(): void
    {
        $this->validate();

        session([ 'by_person_start_date' => $this->by_person_start_date ]);
        session([ 'by_person_end_date' => $this->by_person_end_date ]);
        session([ 'by_person_user_id' => $this->by_person_user_id ]);

        $dates = CarbonPeriod::create($this->by_person_start_date, $this->by_person_end_date );
        $selectedDates = [];
        foreach( $dates as $d )
        {
            $selectedDates[] = $d->format('Y-m-d');
        }

        $this->emit('cancel' );


        $this->emit('loadData', [
            'users' => [$this->by_person_user_id],
            'dates' => array_reverse( $selectedDates )
        ]);

    }


    public function byDepartment(): void
    {
        $this->validate();

        session([ 'selected_department_id' => $this->department_id ]);
        session([ 'by_department_date' => $this->by_department_date ]);

        $this->emit('cancel' );

        $this->emit('loadData', [
            'users' => User::role('labour')
                ->where('department_id', $this->department_id )
                ->where('is_enabled', true )
                ->orderBy('last_name')
                ->pluck('id')
                ->toArray(),
            'dates' => [ $this->by_department_date ]
        ]);

    }



    /**
     * @param string $tab
     */
    public function setTab( string $tab ): void
    {
        $this->activeTab = $tab;
        session([ 'labour_management_active_tab' => $tab ]);
    }



    /**
     * @return View
     */
    public function render(): View
    {
        return view('labour::management.user_filter');
    }
}
