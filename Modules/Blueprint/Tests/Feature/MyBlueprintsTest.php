<?php

namespace Modules\Blueprint\Tests\Feature;

use App\Models\User;

use Tests\TestCase;


class MyBlueprintsTest extends TestCase
{


    public User $user;
    public User $dealer;

    public function setUp(): void
    {
        parent::setUp();
        $this->dealer =  User::permission('use_blueprint')
            ->whereNotIn('company_id', [1, 2])
            ->get()
            ->random();
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
    public function see_my_blueprints_if_going_to_my_dashboard()
    {
        $this->setUrl();
        $this->actingAs( $this->dealer )
            ->get('/blueprint/my_blueprints/' )
//            ->assertSee(  str_possessive( $this->dealer->first_name ) .' Blueprints');
            ->assertSee("My Blueprints");
    }


    /** @test */
    public function see_my_name_if_going_to_my_id()
    {
        $this->setUrl();
        $this->actingAs( $this->dealer )
            ->get('/blueprint/my_blueprints/'. $this->dealer->id )
            ->assertSee(  str_possessive( $this->dealer->first_name ) .' Blueprints');
    }



    /** @test */
    public function dealer_can_see_their_coworkers_blueprints()
    {

        $this->setUrl();

        $coWorker = User::permission('use_blueprint')
            ->where('company_id', $this->dealer->company_id)
            ->get()
            ->random();

        $this->actingAs( $this->dealer )
            ->get('/blueprint/my_blueprints/'. $coWorker->id )
            ->assertSee(  str_possessive( $coWorker->first_name ) .' Blueprints')
            ->assertStatus(200);

    }

    /** @test */
    public function dealer_cant_see_non_coworker_blueprints()
    {

        $this->setUrl();

        $coWorker = User::permission('use_blueprint')
            ->where('company_id', '!=', $this->dealer->company_id)
            ->get()
            ->random();

        $this->actingAs( $this->dealer )
            ->get('/blueprint/my_blueprints/'. $coWorker->id )
            ->assertStatus(  403 );

    }



    /** @test */
    public function malley_staff_can_see_anyone_blueprint()
    {
        $this->setUrl();

        $staff = User::permission('use_blueprint')
            ->where('company_id', 2)
            ->get()
            ->random();

        $dealer = User::whereNotIn('company_id' , [1,2])
            ->get()
            ->random();

        $this->actingAs( $staff )
            ->get('/blueprint/my_blueprints/'. $dealer->id )
            ->assertSee(  str_possessive( $dealer->first_name ) .' Blueprints')
            ->assertStatus(200);
    }
}