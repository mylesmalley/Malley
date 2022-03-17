<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class LabourPolicy
{
    use HandlesAuthorization;

    //Permission::create(['name' => 'labour_clock_in']);
    //Permission::create(['name' => 'labour_edit']);
    //Permission::create(['name' => 'labour_reports']);
    //Permission::create(['name' => 'labour_post']);

    /**
     * @param User $user
     * @return bool
     */
    public function manage_labour(User $user): bool
    {
        return $user->can('manage_labour');
    }

    public function labour_clock_in(User $user): bool
    {
        return $user->can('labour_clock_in');
    }

    public function labour_reports(User $user): bool
    {
        return $user->can('labour_reports');
    }

    public function labour_post(User $user): bool
    {
        return $user->can('labour_post');
    }
}
