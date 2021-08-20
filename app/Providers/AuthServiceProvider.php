<?php

namespace App\Providers;

use App\Models\Company;
use App\Models\User;
use App\Models\Labour;
use App\Models\Blueprint;
use App\Policies\CompanyPolicy;
use App\Policies\LabourPolicy;
use App\Policies\BlueprintPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        User::class => UserPolicy::class,
        Blueprint::class => BlueprintPolicy::class,
        Company::class => CompanyPolicy::class,
        Labour::class => LabourPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // super admin user role should always get a pass.
        Gate::before(function ($user, $ability) {
            if ( $user->hasRole('super_admin') ) return true;

            if ( $user->hasRole('disabled_user_account')
                || $user->hasRole('disabled_staff_account') ) return false;

            return null;
        });


    }
}
