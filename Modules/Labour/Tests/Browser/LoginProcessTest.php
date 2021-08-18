<?php

namespace Modules\Labour\Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class LoginProcessTest extends DuskTestCase
{

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user = User::all()->random();
    }




    /** @test */
    public function navigating_login_form()
    {
        $this->browse(function (Browser $browser, Browser $two) {
            $browser->visit('/labour')
                    // see the page
                    ->assertSee('First Letter of Last Name')

                    // click a letter and see that letter's staff
                    ->press("@alphabet-button-B")
                    ->waitFor('@deselectLetter') // wait for the back button to appear
                    ->assertSee('B Staff')

                    // should not see alphabet
                    ->assertDontSee('First Letter of Last Name')
                    ->press('@deselectLetter')
                    ->waitFor('@alphabet-button-M') // wait for the alphabet to reappear
                    // back to start
                    ->assertSee('First Letter of Last Name')
                    // pick a letter
                  ->press("@alphabet-button-". substr($this->user->last_name, 0, 1 ) )
                ->waitFor('@deselectLetter')
                // click on myles
                ->assertSee( $this->user->first_name )
                ->press('@deselectLetter')
                // go back to alphabet
                ->waitFor('@alphabet-button-D')
                ->press("@alphabet-button-". substr($this->user->last_name, 0, 1 ) )
                ->waitFor("@select-{$this->user->first_name}-{$this->user->last_name}")
                ->press("@select-{$this->user->first_name}-{$this->user->last_name}")
                // wait for the back button to appear
                ->waitFor('@deselectUser')
                ->assertSee("Hello, {$this->user->first_name}");
        });
    }





}
