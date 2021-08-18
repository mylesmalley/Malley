<?php

namespace Modules\Labour\Tests\Feature;

use Modules\Labour\Http\Livewire\LoginForm;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\Alphabet;

class LoginPageTest extends TestCase
{
    /** @test */
    public function load_pin_pad_component()
    {
        $this->get('/labour')
            ->assertSeeLivewire("labour::login-form");
    }

    /** @test */
    public function load_alphabet_component()
    {
        $this->get('/labour')
            ->assertSeeLivewire("labour::alphabet");
    }

    /** @test */
    public function load_letter_component()
    {
        $this->get('/labour')
            ->assertSeeLivewire("labour::letter");
    }


}
