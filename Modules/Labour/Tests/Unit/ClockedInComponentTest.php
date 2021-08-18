<?php

namespace Modules\Labour\Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\ClockedIn;

class ClockedInComponentTest extends TestCase
{
    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();
    }



    /** @test */
//    public function shows_name()
//    {
//        Livewire::test(ClockedIn::class, ['user' => $this->user ])
//            ->assertSeeHtml("Hi, {$this->user->first_name}");
//    }

    /** @test */
    public function see_clock_out_button()
    {
        Livewire::test(ClockedIn::class, ['user' => $this->user ])
            ->assertSeeHtml("clockOutButton");
    }



    /** @test */
    public function does_not_appear_when_user_is_not_active()
    {
        $this->actingAs( $this->user );

    //    dd( $this->user->activeLabour()->finish() );

        if ( $this->user->activeLabour() !== null )
        {
            $this->user->activeLabour()->finish();
        }

        $this->get('/labour/home')
            ->assertDontSee("clock-in");
    }




}
