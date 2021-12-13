<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use App\Models\Labour;

class SysproJobs extends Component
{
    public Collection $prefixes;
    public string $selectedTab;
    public Collection $results ;
    public bool $searchMode = false;
    public string $searchTerm = '';


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

        // grab the 10 most recent labour rows from the blueprint db
        $users_jobs = Labour::where('user_id', Auth::user()->id )
            ->pluck('job') // only job
            ->unique()  // unique values
            ->values()
            ->take(10); // trim to at most 10

        // grab the records from syspro that match those job codes
        $this->results = DB::connection('syspro')
            ->table('WipMaster')
            ->select('Job', 'JobDescription')
            ->where( 'Complete' , '=', 'N' ) // only show active jobs
            ->whereIn('Job', $users_jobs)
            ->get();
    }

    /**
     * Receives a string and returns the jobs in syspro that match
     * @param string $tab
     */
    public function clickTab( string $tab ): void
    {
        $this->selectedTab = $tab;
        $this->searchMode = false;

        $this->results =
            Cache::remember('_syspro_job_tab_search_tab_'.$tab ,
                Carbon::now()->minutes(15), function() use ($tab) {

                    return DB::connection('syspro')
                        ->table('WipMaster')
                        ->select('Job', 'JobDescription')
                        ->where('Complete', '=', 'N')
                        ->where('Job', 'like', $tab . "%")
                        ->orderBy('Job', 'ASC')
                        ->get();
                });
    }


    /**
     * set up the component
     */
    public function mount(): void
    {
        $this->results = collect([]);

        $this->prefixes =
            Cache::remember('_syspro_all_job_prefixes' ,
                Carbon::now()->hours(24), function() {
                  return  DB::connection('syspro')
                        ->table('WipMaster')
                        ->selectRaw("  LEFT(Job,3)  AS Prefix ")
                        ->where('Complete', '=', 'N')
                        ->orderBy('Prefix', 'ASC')
                        ->distinct('Prefix')
                        ->pluck('Prefix');
                });



        $this->selectedTab = $this->prefixes->first();

        $this->clickTab( $this->selectedTab );
    }


    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.syspro-jobs');
    }
}
