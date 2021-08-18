<?php

namespace Modules\Labour\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\Letter;
use App\Models\User;

class LetterComponentTest extends TestCase
{

    public User $user;
    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();
    }


    /** @test */
    public function redirect_if_not_authorized()
    {

    }

    /** @test  */
    public function hidden_on_first_load()
    {
        Livewire::test(Letter::class)
        ->assertDontSeeHtml("<div class=\"card border-primary\">");
    }

    /** @test */
    public function shows_on_letter_selection()
    {
        Livewire::test(Letter::class)
            ->emit("letterSelected",["letter"=> "E" ])
            ->assertSeeHTML("<!-- Employee Picker -->");
    }

    /** @test */
    public function letter_submitted_must_validate()
    {
        Livewire::test(Letter::class)
            ->call('letterSelected', ['letter' =>"E" ])
            ->assertHasNoErrors("letter" )
            ->call('letterSelected', ['letter' =>"E$" ])
            ->assertHasErrors(["letter" => 'max'] )
            ->call('letterSelected', ['letter' =>"#" ])
            ->assertHasErrors(["letter" => 'alpha'] );
    }



    /** @test */
    public function back_button_fires_deselect_event()
    {
        Livewire::test(Letter::class)
            ->call('deselectLetter')
            ->assertEmitted('deselectLetter');
    }

    /** @test */
    public function contains_my_name_when_letter_M_selected()
    {
        Livewire::test(Letter::class)
            ->call('letterSelected', ['letter' => substr($this->user->last_name, 0,1) ])
            ->assertSee($this->user->first_name . ' ' . $this->user->last_name )
            ->assertDontSee("John Smith");
    }

    /** @test */
    public function fires_user_selected_event_when_user_clicked()
    {
        Livewire::test(Letter::class)
            ->call('selectUser', 3)
            ->assertEmitted('selectedUser',['user_id' => 3 ]);
    }

    /** @test */
    public function hide_when_user_selected()
    {
        Livewire::test(Letter::class)
            ->call('letterSelected', ['letter' =>"M" ])
            ->call('selectUser', 3)
            ->assertDontSeeHtml("<!-- Employee Picker -->");
    }

    /** @test */
    public function show_when_user_deseleccted()
    {
        Livewire::test(Letter::class)
            ->call('letterSelected', ['letter' =>"T" ])
            ->call('selectUser', 3)
            ->call('userDeselected')
            ->assertSeeHtml("<!-- Employee Picker -->");
    }

}
