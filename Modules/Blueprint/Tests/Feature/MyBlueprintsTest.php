<?php

namespace Modules\Labour\Tests\Feature;

use App\Models\User;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;

class MyBlueprintsTest extends TestCase
{


    public User $user;

    public function setUp(): void
    {
        parent::setUp();
        $this->user =  User::permission('use_blueprint')->get()->random();
    }


    public function setUrl()
    {
        request()->headers->set('HOST', config('malley.external_domain') );
    }


    /** @test */
    public function redirect_if_not_logged_in()
    {
        $this->setUrl();
        $this->get('/blueprint/my_blueprints')
            ->assertLocation('/login');
    }





    /** @test */
    public function see_name_if_logged_in()
    {
        $this->setUrl();
        $this->actingAs( $this->user )
            ->get('/blueprint/my_blueprints')
            ->assertSee('My Blueprints')
            ->assertLocation('/blueprint/my_blueprints');
//            ->assertLocation('/login');
    }




}