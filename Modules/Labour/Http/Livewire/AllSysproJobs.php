<?php /** @noinspection PhpMissingFieldTypeInspection */

namespace Modules\Labour\Http\Livewire;


/**
 *
 * THIS IS THE LIVEWIRE COMPONENT USED FOR FILTERING JOBS TO GET TO REPORTS
 *
 *
 *
 */
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination;



class AllSysproJobs extends Component
{
    use WithPagination;

    public Collection $prefixes;
    public string $selectedTab;
    public Collection $results ;
    public bool $searchMode = false;
    public string $searchTerm = '';


    public int $offset = 0;
    public int $number_of_results = 0;


    public function clickTabSearch(): void
    {
        $this->selectedTab = "SEARCH";
        $this->searchMode = true;
        $this->searchTerm = '';
        $this->results = collect([]);
    }


    public function increment()
    {
        $this->offset += 25;
        $this->clickTab( $this->selectedTab );
    }

    public function decrement()
    {
        if ( $this->offset >= 25)
        {
            $this->offset -= 25;

        } else
        {
            $this->offset = 0;
        }
        $this->clickTab( $this->selectedTab );
    }


    public function submitSearch(): void
    {

        if ( strlen( $this->searchTerm ) >= 2)
        {
            $this->results = DB::connection('syspro')
                ->table('WipMaster')
                ->select('Job', 'JobDescription')
             //   ->where( 'Complete' , '=', 'N' ) // only show active jobs
             ->orderBy('Job', 'DESC')
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
     * Receives a string and returns the jobs in syspro that match
     * @param string $tab
     */
    public function clickTab( string $tab ): void
    {
        $this->selectedTab = $tab;
        $this->searchMode = false;

        $this->results =
             DB::connection('syspro')
                ->table('WipMaster')
                ->select('Job', 'JobDescription')
                ->where('Job', 'like', $tab . "%")
                ->orderBy('Job', 'DESC')
                ->limit(25)
                 ->offset( $this->offset )
                ->get();

        $this->number_of_results = DB::connection('syspro')
            ->table('WipMaster')
            ->select('Job', 'JobDescription')
            ->where('Job', 'like', $tab . "%")
            ->count();
    }


    /**
     * set up the component
     */
    public function mount(): void
    {
        $this->results = collect([]);

        $this->prefixes = DB::connection('syspro')
                        ->table('WipMaster')
                        ->selectRaw("  LEFT(Job,3)  AS Prefix ")
                        ->orderBy('Prefix', 'ASC')
                        ->distinct('Prefix')
                        ->pluck('Prefix');


        $this->selectedTab = $this->prefixes->first();

        $this->clickTab( $this->selectedTab );
    }


    /**
     * @return Application|Factory|View
     */
    public function render(): View|Factory|Application
    {
        return view('labour::livewire.all-syspro-jobs');
    }
}
