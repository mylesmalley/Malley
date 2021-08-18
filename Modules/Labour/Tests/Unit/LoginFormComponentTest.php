<?php

namespace Modules\Labour\Tests\Unit;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\LoginForm;

class LoginFormComponentTest extends TestCase
{

    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();
    }


    /** @test  */
    public function hidden_on_load()
    {


        Livewire::test(LoginForm::class)
            ->assertDontSeeHtml("<!--  PinPad Component -->");

    }


    /** @test  */
    public function show_when_user_selected()
    {
        Livewire::test(LoginForm::class)
          //  ->emit('selectedUser', ['user_id'=>3])
            ->emit('selectedUser', ['user_id'=> $this->user->id ])
            ->assertSeeHtml("<!--  PinPad Component -->");
    }


    /** @test  */
    public function user_id_must_be_valid()
    {
        Livewire::test(LoginForm::class)
            ->emit('selectedUser', ['user_id'=>$this->user->id])
            ->assertHasNoErrors("user_id" );
    }


    /** @test  */
    public function user_model_loaded_when_id_provided()
    {
        Livewire::test(LoginForm::class )
            ->emit('selectedUser', ['user_id'=>$this->user->id])
            ->assertSet("user", User::find($this->user->id) );
    }


    /** @test  */
    public function hide_when_user_deselected()
    {
        Livewire::test(LoginForm::class)
            ->emit('selectedUser', ['user_id'=>$this->user->id])
            ->call('deselectUser')
            ->assertDontSeeHtml("<!--  PinPad Component -->");
    }


    /** @test  */
    public function shows_my_info_when_prompted()
    {
        Livewire::test(LoginForm::class)
            ->emit('selectedUser', ['user_id'=>$this->user->id])
            ->assertSeeHtml($this->user->first_name );
    }


//    /** @test  */
//    public function pin_pad_receives_digits_as_expected()
//    {
//        Livewire::test(LoginForm::class)
//            ->emit('selectedUser', ['user_id'=>3])
//            ->set('pin', "xyzABC" )
//            ->set('pin', '1234ABC')
//            ->assertSeeHtml("1234ABC")
//        ;
//    }


    /** @test  */
//    public function submit_button_only_appears_when_pin_is_long_enough()
//    {
//        Livewire::test(LoginForm::class)
//            ->emit('selectedUser', ['user_id'=>3])
//            ->set('pin', "123" )
//            ->assertDontSeeHtml("Log In")
//            ->set('pin', '1234ABC')
//            ->assertSeeHtml("Log In")
//            ->set('pin', '12')
//            ->assertDontSeeHtml("Log In");
//    }
}
