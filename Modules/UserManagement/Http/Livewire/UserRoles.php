<?php

namespace Modules\UserManagement\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Role;
use Illuminate\View\View;

class UserRoles extends Component
{
    public User $user;
    public Collection $permissions;
    public Collection $roles;

    /**
     * @param User $user
     */
    public function mount( User $user ): void
    {
        $this->user = $user;
        $this->permissions = $user->getAllPermissions();


        if ( $user->company_id === 2)
        {
            $this->roles = Role::all()->pluck('name')->except(['disabled_user_account','disabled_staff_account']);
        }
        else
        {
            $this->roles = collect(['blueprint']);
        }

    }


    /**
     * @param string $role_name
     */
    public function toggleRole( string $role_name ): void
    {

        if ( $this->user->hasRole( $role_name ))
        {
            $this->user->removeRole( $role_name)->save();
        }
        else
        {
            $this->user->assignRole( $role_name)->save();
        }

        $this->permissions = $this->user->getAllPermissions();

    }


    /**
     *
     */
    public function enableAccount(): void
    {
        $this->user->is_enabled = true;
        $this->user->save();

    }


    /**
     *
     */
    public function disableAccount(): void
    {
        $this->user->is_enabled = false;

        // remove roles
        foreach($this->user->roles as $role)
        {
            $this->user->removeRole( $role->name );
        }
        $this->user->assignRole( 'disabled_user_account' );

        $this->permissions = $this->user->getAllPermissions();

        $this->user->save();

    }


    /**
     * @return View
     */
    public function render(): View
    {
        return view('usermanagement::livewire.user-roles');
    }
}
