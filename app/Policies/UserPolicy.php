<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class UserPolicy
{
    use HandlesAuthorization;


    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return mixed
     */
    public function all(User $user): bool
    {
        return $user->hasAnyRole(['super_admin','user_admin']);
    }

    /**
     * @param User $user
     * @return bool
     */
    public function manage_general_users( User $user ): bool
    {
        return $user->can('manage_general_users');
    }

    /**
     * @param User $user
     * @return bool
     */
    public function manage_production_staff( User $user ): bool
    {
        return $user->can('manage_production_staff');
    }


}
