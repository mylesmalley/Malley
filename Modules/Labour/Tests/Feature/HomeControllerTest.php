<?php

namespace Modules\Labour\Tests\Feature;

use App\Models\User;
use Modules\Labour\Http\Livewire\LoginForm;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Modules\Labour\Http\Livewire\Alphabet;

class HomeControllerTest extends TestCase
{


    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('labour_clock_in')->get()->random();
    }

    /** @test */
    public function cant_access_home_page_when_not_logged_in()
    {
        $this->get('/labour/home')
            ->assertLocation('/labour');
    }




}
