<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\Department;
use App\Models\Labour;
use App\Models\User;
use Illuminate\Database\Seeder;
use League\Flysystem\Exception;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class UserAndLabourSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        // SUPER ADMIN

        // drop some stuff into this table
        Department::insert([
            ['name' => 'Assembly'],
            ['name' => 'Electrical'],
            ['name' => 'Plastics'],
            ['name' => 'Upholstery'],
        ]);

        // CREATE A NO-COMPANY COMPANY
        Company::factory([
            'name' => 'Not Yet Assigned',
        ])->create();

        // create Malley
        Company::factory([
            'name' => 'Malley Industries',
            'address_1' => '1100 Aviation Avenue',
        ])->create();

        // random other dealers
        Company::factory(7)->create();

        // production staff
        $production_staff = User::factory(10)
            ->malley()
            ->hasDepartment()
            ->has(Labour::factory()->count(2), 'labour')
            ->has(Labour::factory()->active()->count(1), 'labour')
            ->create();

        $malley_staff = User::factory(10)
            ->malley()
            ->create();

        // add malley staff to blueprint role
        foreach ($malley_staff as $s) {
            $s->assignRole('blueprint');
        }

        // add production staff to labour role
        foreach ($production_staff as $s) {
            $s->assignRole('labour');
        }

        // create random dealer employee accounts
        $dealers = User::factory(50)
            ->not_malley()
            ->create();

        foreach ($dealers as $s) {
            $s->assignRole('blueprint');
        }

        // create ADMIN account
        $myles = User::factory([
            'first_name' => 'Myles',
            'last_name' => 'Malley',
            'email' => 'mmalley@malleyindustries.com',
            'company_id' => 1,
            'is_enabled' => 1,
        ])
            ->create();

        $myles->assignRole('super_admin');
    }
}
