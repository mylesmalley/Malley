<?php

namespace Modules\UserManagement\Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\User;

class HomePageTestOld extends TestCase
{
    /** @test */
    public function redirect_when_not_logged_in()
    {
        $this->get('/usermanagement')
            ->assertSee('login');
    }

    /** @test */
    public function prevent_unauthorized_login()
    {
        $this->actingAs( User::where("first_name", '!=', 'Myles')->get()->random() )
            ->get('/usermanagement')
            ->assertSee('unauthorized.');
    }

    /** @test */
    public function show_home_page_when_authorized_and_logged_in()
    {
        $this->actingAs( User::where('first_name', 'Myles')->first() )
            ->get('/usermanagement')
            ->assertSee('User Management');
    }

    /** @test */
    public function admin_sees_admin_menu()
    {
        $this->actingAs( User::where('first_name', 'Myles')->first() )
            ->get('/usermanagement')
            ->assertSee('Malley Menu')
            ->assertSee('Admin');
    }
}
