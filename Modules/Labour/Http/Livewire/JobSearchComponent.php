<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Labour;
use App\Models\User;

class JobSearchComponent extends Component
{
    public Collection $prefixes;
    public string $selectedTab;
    public Collection $results ;
    public bool $searchMode = false;
    public string $searchTerm = '';
    public ?User $user;
    public bool $visible;


    protected $listeners = [
        'manageTime',
        'cancelManageTime',
        'addTime',
    ];

    public function manageTime( array $payload )
    {
        $this->visible = true;
        $this->user = Labour::where('id', '=', $payload['labour_id'])
            ->first()
            ->user;

        $this->clickTabRecent();
    }

    public function addTime( array $payload )
    {
        $this->visible = true;
        $this->user = User::find( $payload['user_id']);

        $this->clickTabRecent();
    }


    public function cancelManageTime()
    {
        unset( $this->user );
        $this->visible = false;
    }






    public function clickTabSearch(): void
    {
        $this->selectedTab = "SEARCH";
        $this->searchMode = true;
        $this->searchTerm = '';
        $this->results = collect([]);
    }


    public function submitSearch(): void
    {

        if ( strlen( $this->searchTerm ) >= 2)
        {
            $this->results = DB::connection('syspro')
                ->table('WipMaster')
                ->select('Job', 'JobDescription')
                ->where( 'Complete' , '=', 'N' ) // only show active jobs
                ->where('Job', 'like', '%' . strtoupper( $this->searchTerm ) .'%')
                ->limit(10)
                ->get();
        }
        else
        {
            // reset results if the string isn't long enough or has been cleared.
            $this->results = collect([]);
        }

    }


    /**
     * generates info for a tab to show recently worked on jobs
     */
    public function clickTabRecent(): void
    {
        $this->selectedTab = "RECENT";
        $this->searchMode = false;



        // grab the records from syspro that match those job codes
        $this->results = Cache::remember('user_'.$this->user->id.'_recent_jobs',
            Carbon::now()->addDay(), function() {

                // grab the 10 most recent labour rows from the blueprint db
                $users_jobs = Labour::where('user_id', $this->user->id )
                    ->pluck('job') // only job
                    ->unique()  // unique values
                    ->values()
                    ->take(10); // trim to at most 10



            return DB::connection('syspro')
                ->table('WipMaster')
                ->select('Job', 'JobDescription')
                ->where( 'Complete' , '=', 'N' ) // only show active jobs
                ->whereIn('Job', $users_jobs)
                ->get();
        });






    }


    /**
     * set up the component
     */
    public function mount( User $user ): void
    {
       $this->results = collect([]);

       $this->user = $user;
//
//        $this->prefixes = DB::connection('syspro')
//            ->table('WipMaster')
//            ->selectRaw("  LEFT(Job,3)  AS Prefix ")
//            ->where('Complete', '=', 'N')
//            ->orderBy('Prefix', 'ASC')
//            ->distinct('Prefix')
//            ->pluck('Prefix');
//
//        $this->selectedTab = $this->prefixes->first();
//
//        $this->clickTab( $this->selectedTab );
        $this->clickTabRecent();
    }


    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.job-search-component');
    }
}
