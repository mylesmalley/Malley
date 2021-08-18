<?php

namespace Modules\Labour\Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\Alphabet;

class AlphabetComponentTest extends TestCase
{

    /** @test  */
    public function renders_correctly()
    {
        Livewire::test(Alphabet::class)
        ->assertSeeHtml("wire:click=\"selectLetter('E')\"");

    }

    /** @test  */
    public function fires_event_when_letter_selected()
    {
        Livewire::test(Alphabet::class)
            ->call('selectLetter', "E")
            ->assertEmitted("letterSelected",["letter"=> "E" ] );
    }


    /** @test */
    public function accepts_letters_only()
    {
        Livewire::test(Alphabet::class)
            ->call('selectLetter', "E")
            ->assertHasNoErrors("letter" )
            ->call('selectLetter', "EE")
            ->assertHasErrors(["letter" => 'max'] )
            ->call('selectLetter', "$")
            ->assertHasErrors(["letter" => 'alpha'] );
    }

    /** @test  */
    public function not_visible_after_letter_selected()
    {
        Livewire::test(Alphabet::class)
            ->call('selectLetter', "X")
            ->assertDontSeeHtml("wire:click=\"selectLetter('E')\"");
    }

    /** @test  */
    public function visible_after_deselecting_letter()
    {
        Livewire::test(Alphabet::class)
            ->call('selectLetter', "Q")
            ->emit('deselectLetter')
            ->assertSeeHtml("wire:click=\"selectLetter('E')\"");
    }
}
