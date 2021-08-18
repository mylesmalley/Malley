<?php

namespace Modules\Labour\Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class UnsuccessfulLoginTest extends DuskTestCase
{
    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::all()->random();
    }
    /** @test */
    public function submit_login_form_incorrectly()
    {
        $this->browse(function (Browser $browser) {

            $browser->visit('/labour')
                ->press("@alphabet-button-". substr($this->user->last_name, 0, 1 ) )
                // wait for staff list for letter to load
                ->waitFor("@select-{$this->user->first_name}-{$this->user->last_name}")
                ->press("@select-{$this->user->first_name}-{$this->user->last_name}")
                // wait for login component to load
                ->waitFor('@deselectUser')
                ->type("password", 'asdfasdfasdfdsa')
                ->press("@submitLoginFormButton")
             //   ->screenshot('failed-login-error')
                //                ->screenshot('filled-in-password')
                ->assertPathIs('/labour/'. $this->user->id )
                ->pause(400)
                ->assertSee('Labour Login')
                ->assertSee('Please retry your password');
             //   ->screenshot('failed-login');

        });
    }
}
