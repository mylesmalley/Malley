<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Labour;
use App\Models\Department;

use Illuminate\Database\Seeder;

use League\Flysystem\Exception;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Exceptions\RoleDoesNotExist;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();


// Reset cached roles and permissions
     //   app()->make(\Spatie\Permission\PermissionRegistrar::class)->forgetCachedPermissions();
     //   app()[PermissionRegistrar::class]->forgetCachedPermissions();


// roles for locked out users to make filtering easier.
        try {
            $a_role = Role::findByName( 'disabled_user_account');

        } catch (RoleDoesNotExist $e) {
            $a_role = Role::create(['name' => 'disabled_user_account']);
        }

        try {
            $a_role = Role::findByName( 'disabled_staff_account');
        } catch (RoleDoesNotExist $e) {
            $a_role =  Role::create(['name' => 'disabled_staff_account']);
        }


        try {
            $labour = Role::findByName( 'labour');
        } catch (RoleDoesNotExist $e) {
            $labour =  Role::create(['name' => 'labour']);
        }



// regular users roles
//        $labour = Role::create(['name' => 'labour']);
//        $labour_admin = Role::create(['name' => 'labour_admin']);

        try {
            $labour_admin = Role::findByName( 'labour_admin');
        } catch (RoleDoesNotExist $e) {
            $labour_admin =  Role::create(['name' => 'labour_admin']);
        }


//        $accounting = Role::create(['name' => 'accounting']);
        try {
            $accounting = Role::findByName( 'accounting');
        } catch (RoleDoesNotExist $e) {
            $accounting =  Role::create(['name' => 'accounting']);
        }
   //     $admin = Role::create(['name' => 'super_admin']);
        try {
            $admin = Role::findByName( 'super_admin');
        } catch (RoleDoesNotExist $e) {
            $admin =  Role::create(['name' => 'super_admin']);
        }

//        $blueprint = Role::create(['name' => 'blueprint']);
        try {
            $blueprint = Role::findByName( 'blueprint');
        } catch (RoleDoesNotExist $e) {
            $blueprint =  Role::create(['name' => 'blueprint']);
        }

//        $sales = Role::create(['name' => 'sales']);
        try {
            $sales = Role::findByName( 'sales');
        } catch (RoleDoesNotExist $e) {
            $sales =  Role::create(['name' => 'sales']);
        }

//        $sales_admin = Role::create(['name' => 'sales_admin']);
        try {
            $sales_admin = Role::findByName( 'sales_admin');
        } catch (RoleDoesNotExist $e) {
            $sales_admin =  Role::create(['name' => 'sales_admin']);
        }

//        $engineering = Role::create(['name' => 'engineering']);
        try {
            $engineering = Role::findByName( 'engineering');
        } catch (RoleDoesNotExist $e) {
            $engineering =  Role::create(['name' => 'engineering']);
        }

//        $quality = Role::create(['name' => 'quality']);
        try {
            $quality = Role::findByName( 'quality');
        } catch (RoleDoesNotExist $e) {
            $quality =  Role::create(['name' => 'quality']);
        }

//        $warranty = Role::create(['name' => 'warranty']);
        try {
            $warranty = Role::findByName( 'warranty');
        } catch (RoleDoesNotExist $e) {
            $warranty =  Role::create(['name' => 'warranty']);
        }

//        $inspection = Role::create(['name' => 'inspection']);
        try {
            $inspection = Role::findByName( 'inspection');
        } catch (RoleDoesNotExist $e) {
            $inspection =  Role::create(['name' => 'inspection']);
        }

//        $logistics = Role::create(['name' => 'logistics']);
        try {
            $logistics = Role::findByName( 'logistics');
        } catch (RoleDoesNotExist $e) {
            $logistics =  Role::create(['name' => 'logistics']);
        }

//        $purchasing = Role::create(['name' => 'purchasing']);
        try {
            $purchasing = Role::findByName( 'purchasing');
        } catch (RoleDoesNotExist $e) {
            $purchasing =  Role::create(['name' => 'purchasing']);
        }

//        $inventory = Role::create(['name' => 'inventory']);
        try {
            $inventory = Role::findByName( 'inventory');
        } catch (RoleDoesNotExist $e) {
            $inventory =  Role::create(['name' => 'inventory']);
        }



// LABOUR RELATED PERMISSIONS
//        Permission::create(['name' => 'labour_clock_in']);
        try {
            $labour_clock_in = Permission::create(['name' => 'labour_clock_in']);
        } catch (PermissionAlreadyExists $e) {
            $labour_clock_in = 'labour_clock_in';
        }

//        Permission::create(['name' => 'labour_edit']);
        try {
            $labour_edit = Permission::create(['name' => 'labour_edit']);
        } catch (PermissionAlreadyExists $e) {
            $labour_edit = 'labour_edit';
        }

//        Permission::create(['name' => 'labour_reports']);
        try {
            $labour_reports = Permission::create(['name' => 'labour_reports']);
        } catch (PermissionAlreadyExists $e) {
            $labour_reports = 'labour_reports';
        }

//        Permission::create(['name' => 'labour_post']);
        try {
            $labour_post = Permission::create(['name' => 'labour_post']);
        } catch (PermissionAlreadyExists $e) {
            $labour_post = 'labour_post';
        }


//        Permission::create(['name' => 'manage_general_users']);
        try {
            $manage_general_users= Permission::create(['name' => 'manage_general_users']);
        } catch (PermissionAlreadyExists $e) {
            $manage_general_users = 'manage_general_users';
        }

//        Permission::create(['name' => 'manage_production_staff']);
        try {
            $manage_production_staff = Permission::create(['name' => 'manage_production_staff']);
        } catch (PermissionAlreadyExists $e) {
            $manage_production_staff = 'manage_production_staff';
        }

//        Permission::create(['name' => 'manage_companies']);
        try {
            $manage_companies = Permission::create(['name' => 'manage_companies']);
        } catch (PermissionAlreadyExists $e) {
            $manage_companies = 'manage_companies';
        }





        try {
            $use_blueprint = Permission::create(['name' => 'use_blueprint']);
        } catch (PermissionAlreadyExists $e) {
            $use_blueprint = 'use_blueprint';
        }


        if (!$blueprint->hasPermissionTo($use_blueprint)) {
            $blueprint->givePermissionTo($use_blueprint);
        }



// labour
      //  $labour->givePermissionTo($labour_clock_in);
        if (!$labour->hasPermissionTo($labour_clock_in)) {
            $labour->givePermissionTo($labour_clock_in);
        }


// labour admin
//        $labour_admin->givePermissionTo('labour_clock_in');
        if (!$labour->hasPermissionTo($labour_clock_in)) {
            $labour->givePermissionTo($labour_clock_in);
        }

//        $labour_admin->givePermissionTo('labour_edit');
        if (!$labour_admin->hasPermissionTo($labour_edit)) {
            $labour_admin->givePermissionTo($labour_edit);
        }

//        $labour_admin->givePermissionTo('manage_production_staff');
        if (!$labour_admin->hasPermissionTo($manage_production_staff)) {
            $labour_admin->givePermissionTo($manage_production_staff);
        }


// accounting
//        $accounting->givePermissionTo('labour_edit');
        if (!$accounting->hasPermissionTo($labour_edit)) {
            $accounting->givePermissionTo($labour_edit);
        }

//        $accounting->givePermissionTo('labour_post');
        if (!$accounting->hasPermissionTo($labour_post)) {
            $accounting->givePermissionTo($labour_post);
        }

//        $accounting->givePermissionTo('manage_production_staff');
        if (!$accounting->hasPermissionTo($manage_production_staff)) {
            $accounting->givePermissionTo($manage_production_staff);
        }

    }

}
