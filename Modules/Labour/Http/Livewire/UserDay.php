<?php

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Collection;
use Livewire\Component;
use Illuminate\View\View;
use Modules\Labour\Models\UserDay as UD;
use App\Models\User;

class UserDay extends Component
{

    public bool $locked = false;

    public User $user;
    public Carbon $date;
    public Collection $labour;

    // used to highlight if a particular row is active or not
    public int $selectedRow;

    public bool $adding_row_indicator;


    protected $listeners = [
     //   'refreshLabour',
        'lockUserDay',
        'unlockUserDay',
    ];


    public function lockUserDay(): void
    {

        $this->locked = true;
        $this->refreshLabour();
    }


    public function unlockUserDay(): void
    {
        $this->locked = false;
        $this->refreshLabour();
        unset( $this->selectedRow );
        unset( $this->adding_row_indicator );
    }


    public function mount( UD $userDay )
    {
        $this->user = $userDay->user;
        $this->date = $userDay->date;
        $this->labour = $userDay->labour;
    }

    public function refreshLabour()
    {
        $ud  = new UD($this->user, $this->date );
        $this->labour = $ud->labour;
    }


    public function clockOutRow( int $id )
    {
        $this->emit('lockUserDay'  );
      //  $this->emit('deselectLabourRecord'  );
        $this->selectedRow = $id;
        $this->emit('clockOutLabourRecord',  ['id' => $id  ]);
    }

    public function editRow( int $id )
    {
        $this->emit('lockUserDay'  );
        $this->selectedRow = $id;
      //  $this->emit('deselectLabourRecord'  );
        $this->emit('editLabourRecord',  ['id' => $id  ] );
    }

    public function addRow()
    {
        $this->emit('lockUserDay'  );
        $this->adding_row_indicator = true;
  //      $this->emit('deselectLabourRecord'  );
        $this->emit('addLabourRecord',  [
            'user_id' => $this->user->id,
            'date' => $this->date->toIso8601String(),
        ]);
    }


//    public function clickLabourRecordRow( int $labour_id )
//    {
//        // turn off any active records
//        $this->emit( 'deselectLabourRecord');
//
//        // highlihgt this component's child row
//        $this->selectedRow = $labour_id;
//
//        // let everyone know this one is on
//        $this->emit( 'selectedLabourRecord', ['labour_id' => $labour_id ]);
//    }

    /**
     * @return View
     */
    public function render(): View
    {
        return view('labour::livewire.user-day');
    }
}
