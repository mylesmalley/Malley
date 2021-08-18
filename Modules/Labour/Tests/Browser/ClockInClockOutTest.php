<?php

namespace Modules\Labour\Tests\Browser;

use App\Models\User;
use App\Models\Labour;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\DB;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class ClockInClockOutTest extends DuskTestCase
{

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::all()->random();

    }


    /** @test */
    public function user_is_clocked_in_and_can_clock_out()
    {
        $this->browse(function (Browser $browser) {

            // clock them in first...
            if (!$this->user->activeLabour()) {
                $l = new Labour([
                    'user_id' => $this->user->id,
                    'job' => 'xxx',
                    'start' => Carbon::now(),
                    'end' => null,
                ]);
                $l->save();
            }

            $browser->loginAs($this->user)
                ->visit('/labour/home')
                // see the page
                ->assertDontSee('Choose a Job');


        });
    }

    /** @test */
    public function user_is_clocked_out_and_can_clock_in()
    {
        $this->browse(function (Browser $browser) {
            // clock them out first...
            if ($this->user->activeLabour()) {
                $this->user->activeLabour()->finish();
            }

            $browser->loginAs($this->user)
                ->visit('/labour/home')
                // see the page
                ->assertSee('Choose a Job');


        });
    }


    /** @test */
    public function clock_in_then_out_full_run()
    {
        $this->browse(function (Browser $browser) {

            // new dummy user
            $user = User::factory()->create();

            $job = DB::connection('syspro')
                ->table('WipMaster')
                ->select('Job' )
                ->where( 'Complete' , '=', 'N' ) // only show active jobs
                ->get()
                ->random();
            $job = $job->Job;

            $prefix = substr($job, 0, 3);

            $browser->loginAs($user)
                // go to the home page
                ->visit('/labour/home')
                ->assertSee('Choose a Job')

                // go to the recent jobs tab - should be empty
                ->waitFor('@clickTabRecent')
                ->click('@clickTabRecent')
                ->waitFor("@no-jobs-found")
            //    ->assertSee('No jobs found ')
                ->screenshot('chose-recent-jobs-tab')

                // pick a tab and wait for job
//                ->click("@clickTabAAL")
                ->click("@clickTab{$prefix}")
              //  ->pause(1000)
                ->waitFor("@startJob{$job}")
//                ->waitFor("@startJobAAL01401")
                    ->pause(1000)
                ->scrollIntoView("@startJob{$job}")
//                ->scrollIntoView("@startJobAAL01401")
                ->pause(1000)

                // pick a job
                ->click("@startJob{$job}")
                ->waitFor('@clocked-in-component')
                // should be back to the start
                ->assertSee("Hello, ". $user->first_name )
                ->screenshot('see-clock-in-page')

            ->click('@clockOutButton')
                // go to the recent jobs tab - should be empty
                ->waitFor('@clickTabRecent')
                //->scrollIntoView("@clickTabRecent")
              //  ->pause(500)
                ->click("@clickTabRecent")
                ->pause(500)
                ->assertSee( $job )

                ->click("@clickTabSearch")
                ->waitFor('#searchForm')
                ->assertSee("Start typing to search for a job:")
                ->type('#searchterm','a' )
                ->pause(200)
                ->assertSee('No jobs found')
                ->pause(200)
                ->type('#searchterm','aa' )
                ->pause(200)
                ->assertSee('Start on ');
//                ->pause(200)
//
//                ->type('#searchterm','aaasdfadsfdsafds' )
//                ->pause(400)
//                ->assertSee('No jobs found');

              //  ->screenshot('recent-history-after-running-through');






        });

    }


}
