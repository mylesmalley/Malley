<?php

namespace Modules\UserManagement\Tests\Feature;

use App\Models\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegularUsersTest extends TestCase
{

    public User $user;
    public User $nonAdmin;

    /**
     *
     */
    public function setup(): void
    {
        parent::setUp();

        $this->user = User::where('first_name','Myles')->first();

        $this->nonAdmin = User::whereHas('roles', function ($query) {
                                    $query->where('name','!=', 'super_admin');
                                })->where('is_enabled', true)
                                ->get()
                                ->random();
    }

    /** @test */
    public function redirect_when_not_logged_in()
    {
        $this->get(route('users.index'))
            ->assertSee('login');
    }


    /** @test */
    public function cant_access_unless_admin()
    {
        $this->actingAs( $this->nonAdmin )
            ->get(route('users.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function see_all_users()
    {
        $this->actingAs( $this->user )
            ->get(route('users.index'))
            ->assertSee('All Regular Users');
    }

    /** @test */
    public function see_user_in_list()
    {
        $user = User::role('blueprint')->orderBy('last_name')->first();

        $this->actingAs( $this->user )
            ->get(route('users.index'))
            ->assertSee($user->last_name );
    }

    /** @test */

    public function loading_user_shows_name()
    {
        $randomUser = User::role('blueprint')->get()->random();

        $this->actingAs( $this->user )
            ->get(route('users.show', [$randomUser]) )
            ->assertSee($randomUser->last_name );
    }

}
