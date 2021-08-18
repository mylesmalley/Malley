<?php

namespace Modules\Labour\Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class SuccessfullLoginTest extends DuskTestCase
{
    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::all()->random();
    }


    /** @test */
    public function submit_login_form_correctly()
    {
        $this->browse(function (Browser $browser) {

            $browser
                ->visit('/labour')
                ->press("@alphabet-button-". substr($this->user->last_name, 0, 1 ) )
                // wait for staff list for letter to load
                ->waitFor("@select-{$this->user->first_name}-{$this->user->last_name}")
                ->press("@select-{$this->user->first_name}-{$this->user->last_name}")
                // wait for login component to load
                ->waitFor('@deselectUser')

                ->type("password", 'password')
                ->press("@submitLoginFormButton")
//                ->screenshot('filled-in-password')

                ->assertPathIs('/labour/home')


                ->assertSee("Hello, {$this->user->first_name}");

          //      ->screenshot('successful-login');

        });
    }
}
