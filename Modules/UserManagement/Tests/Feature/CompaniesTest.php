<?php

namespace Modules\UserManagement\Tests\Feature;

use App\Models\User;
use App\Models\Company;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CompaniesTest extends TestCase
{

    public User $user;
    public User $nonAdmin;
    public Company $company;

    public function setup(): void
    {
        parent::setUp();

        $this->user = User::where('first_name','Myles')->first();

        $this->nonAdmin = User::whereHas('roles', function ($query) {
                                    $query->where('name','!=', 'super_admin');
                                })->where('is_enabled', true)
                                ->get()
                                ->random();

        $this->company = Company::where('id', '>', 2)
            ->get()
            ->random();
    }

    /** @test */
    public function redirect_when_not_logged_in()
    {
        $this->get(route('companies.index'))
            ->assertSee('login');
    }


    /** @test */
    public function cant_access_unless_admin()
    {
        $this->actingAs( $this->nonAdmin )
            ->get(route('companies.index'))
            ->assertStatus(403);
    }

    /** @test */
    public function add_role_to_user_then_access()
    {
        $new = User::find( $this->nonAdmin->id );
        $new->givePermissionTo('manage_companies');

        $this->actingAs( $new )
            ->get(route('companies.index'))
            ->assertSee("All Companies");
    }

    /** @test */
    public function can_see_all_companies()
    {
        $this->actingAs( $this->user )
            ->get(route('companies.index'))
            ->assertSee($this->company->name );
    }

    /** @test */
    public function create_company_form()
    {
        $this->actingAs( $this->user )
            ->get(route('companies.create'))
            ->assertSee( "New Company" )
            ->assertSee('Logo');
    }

    /** @test */
    public function see_company_info()
    {
        $this->actingAs( $this->user )
            ->get(route('companies.show', [ $this->company ]))
            ->assertSee( $this->company->name );
    }
}
