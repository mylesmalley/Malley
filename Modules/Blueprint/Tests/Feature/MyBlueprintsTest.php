<?php

namespace Modules\Blueprint\Tests\Feature;

use App\Models\User;

use Tests\TestCase;


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
    public function user_has_permission_to_see_blueprint()
    {
        $this->setUrl();

        $this->assertTrue( $this->user->can('use_blueprint') );
    }



    /** @test */
    public function see_name_if_logged_in()
    {
        $this->setUrl();
        $this->actingAs( $this->user )
            ->get('/blueprint/my_blueprints')
            ->assertSee(  str_possessive( $this->user->first_name ) .' Blueprints');
    }


}