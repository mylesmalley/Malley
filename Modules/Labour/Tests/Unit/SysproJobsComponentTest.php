<?php

namespace Modules\Labour\Tests\Unit;

use Modules\Labour\Http\Livewire\SysproJobs;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\LoginForm;

class SysproJobsComponentTest extends TestCase
{

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();

    }

    private function clockOut()
    {
        if ( $this->user->activeLabour() )
        {
            $this->user->activeLabour()
                ->finish();
        }
    }

    /** @test */
    public function loads_as_expected()
    {
        $this->clockOut();

        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->assertSee("Choose a Job");

    }


    /** @test */
    public function has_tabs_showing_different_categories()
    {
        $this->clockOut();


        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->assertSeeInOrder(['RECENT',"AAL", "PB"]);
    }

    /** @test */
    public function clicking_tab_updates_results()
    {
        $this->clockOut();

        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->call('clickTab', 'AAL')
            ->assertSet('selectedTab', 'AAL');
    }

    /** @test */
    public function clicking_recent_tab_updates_results()
    {
        $this->clockOut();

        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->call('clickTabRecent')
            ->assertSet('selectedTab', 'RECENT');
    }

    /** @test */
    public function has_search_box()
    {
        $this->clockOut();

        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->assertSee('SEARCH' )

             ->call('clickTabSearch' )
            ->assertSee('Start typing to search for a job' );
    }

    /** @test */
    public function search_box_returns_results()
    {
        $this->clockOut();

        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->call('clickTabSearch' )
            ->set('searchTerm', 'AAL')
            ->call('submitSearch')
            ->assertSeeHtml("<!-- Search result -->");

    }

    /** @test */
    public function no_search_results_from_gibberish()
    {
        $this->clockOut();

        Livewire::actingAs( $this->user )
            ->test(SysproJobs::class)
            ->call('clickTabSearch' )
            ->set('searchTerm', 'asd fsdf ds  asdfdsafds')
            ->call('submitSearch')
            ->assertDontSeeHtml("<!-- Search result -->");

    }


}
