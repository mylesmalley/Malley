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
        $this->dealer =  User::permission('use_blueprint')->get()->random();
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

        $this->assertTrue( $this->dealer->can('use_blueprint') );
    }



    /** @test */
    public function see_name_if_logged_in()
    {
        $this->setUrl();
        $this->actingAs( $this->dealer )
            ->get('/blueprint/my_blueprints/'. $this->dealer->id )
//            ->assertSee(  str_possessive( $this->dealer->first_name ) .' Blueprints');
            ->assertSee("My Blueprints");
    }


    /** @test */
    public function dealer_can_see_their_own_blueprints()
    {

    }

    /** @test */
    public function dealer_can_see_their_coworkers_blueprints()
    {

    }

    /** @test */
    public function dealer_cant_see_non_coworker_blueprints()
    {

    }

    /** @test */
    public function malley_staff_can_see_their_own_blueprint()
    {

    }

    /** @test */
    public function malley_staff_can_see_anyone_blueprint()
    {

    }
}