<?php

namespace Modules\Labour\Tests\Feature;

use App\Models\User;
use App\Models\Labour;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Modules\Labour\Http\Livewire\LoginForm;
use Modules\Labour\Http\Livewire\SysproJobs;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\Alphabet;

class HomePageTest extends TestCase
{


    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();
    }

    /** @test */
    public function redirect_if_not_logged_in()
    {
        $this->get('/labour/home')
            ->assertLocation('/labour');
    }


    /** @test */
    public function log_in_see_welcome_message()
    {
        $this->actingAs( $this->user )
            ->get('/labour/home')
            ->assertSee("Hello");
    }

    /** @test */
    public function see_syspro_when_clocked_out()
    {
        if ( $this->user->hasActiveLabour )
        {
            $this->user->activeLabour()
                ->finish();
        }

        $this->actingAs( $this->user )
            ->get('/labour/home')
            ->assertStatus(200)
            ->assertSee("syspro-jobs");

//
//      //  dd( $this->user->activeLabour()->finish() );
//    //    $this->assertFalse( $this->user->hasActiveLabour );
//        $this->get('/labour/home')
//      //  Livewire::test(SysproJobs::class )
//            ->actingAs( $this->user )
//            ->assertStatus(200);
//            ->assertSeeHTML("<!-- syspro-jobs -->");

  //      dd( $this->user->hasActiveLabour, $this->user->id );

    }

    /** @test */
    public function dont_see_syspro_when_clocked_in()
    {
        $user =  User::permission('labour_clock_in')->get()->random();


        if ( ! $user->hasActiveLabour )
        {

            Labour::factory([ 'user_id'=>$user->id ])->active()->count(1)->create();

        }
        $user = User::find($user->id);

        $this->actingAs( $user )
            ->get('/labour/home')
            ->assertDontSee('syspro-jobs');

//        dd(  $user->hasActiveLabour );

    }

    /** @test */
    public function see_clocked_in_component_user_is_when_clocked_in()
    {
        $user =  User::permission('labour_clock_in')->get()->random();


        if ( ! $user->hasActiveLabour )
        {
            Labour::factory([ 'user_id'=>$user->id ])->active()->count(1)->create();
        }

        $user = User::find( $user->id );

        $this->actingAs( $user )
            ->get('/labour/home')
            ->assertSee('clocked-in');

    }

    /** @test  */
    public function dont_see_clocked_in_component_when_user_is_clocked_out()
    {
        $user =  User::permission('labour_clock_in')->get()->random();


        if ( $user->hasActiveLabour )
        {
            $user->activeLabour()
                ->finish();
        }

        $this->actingAs( $user )
            ->get('/labour/home')
            ->assertDontSee("clocked-in");
    }





}
