<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Blueprint;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;


class BlueprintPolicy
{
    use HandlesAuthorization;

//    /**
//     * Create a new policy instance.
//     *
//     * @return void
//     */
//    public function __construct()
//    {
//        //
//    }


    /**
     * @param $user
     * @param $ability
     * @return false|null
     */
    public function before($user, $ability): bool|null
    {
//        if (!$user->is_enabled)
//        {
//            abort(403, "Your account has not yet been enabled.");
//            return false;
//        }
    //    die('here');

//        if (!$user->can('use_blueprint'))
//        {
//            abort(403, "You don't have permission to use Blueprint.");
//            return false;
//        }

        return null;
    }


    /**
     * @param User $user
     * @return bool
     */
    public function create( User $user ): bool
    {
        return true;
    }

//
//    public function testtest( User $user )
//    {
//        return $user->id
//            ? Response::allow()
//            : Response::deny('You do not own this post.');
//    }


    /**
     * @param User $user
     * @return bool
     */
    public function home( User $user, Blueprint $blueprint ): bool
    {

        // they own the blueprint
        if ($user->id === $blueprint->user_id) return true;

        // user is malley staff
        if ($user->is_malley_staff) return true;

        // user is of the same company
        if ($user->company->id === $blueprint->user->company_id ) return true;

        abort(403, "You don't have permission to see this Blueprint.");
        return false;

    }


    /**
     * @param User $user
     * @param Blueprint $blueprint
     * @return bool
     */
    public function edit( User $user, Blueprint $blueprint ): bool
    {

        // they own the blueprint
        if ($user->id === $blueprint->user_id) return true;

        // user is malley staff
        if ($user->is_malley_staff) return true;

        // user is of the same company
        if ($user->company->id === $blueprint->user->company_id ) return true;

        abort(403, "You don't have permission to edit this Blueprint.");
        return false;

    }


    /**
     * @param User $user
     * @param Blueprint $blueprint
     * @return bool
     */
    public function update( User $user, Blueprint $blueprint ): bool
    {

        if ( $blueprint->is_locked )
        {
            abort(403, "This Blueprint has been locked and can only be changed by an administrator");
        }

        // they own the blueprint
        if ($user->id === $blueprint->user_id) return true;

        // user is malley staff
        if ($user->is_malley_staff) return true;

        // user is of the same company
        if ($user->company->id === $blueprint->user->company_id ) return true;


        abort(403, "You don't have permission to edit this Blueprint.");
        return false;

    }




    /*
            C H A N G E S  T O  N O T E S
     */
//
//    /**
//     * @param User $user
//     * @param Blueprint $blueprint
//     * @return bool
//     */
//    public function editNotes( User $user, Blueprint $blueprint ): bool
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "Only Malley staff can edit Blueprint notes.");
//        return false;
//
//    }
//
//    /**
//     * whether or not a user is allowed to edit notes
//     * @param  User      $user      [description]
//     * @param  Blueprint $blueprint [description]
//     * @return [type]               [description]
//     */
//    public function updateNotes( User $user, Blueprint $blueprint )
//    {
//        // don't go further if the blueprint is locked
//        if ( $blueprint->is_locked )
//        {
//            abort(403, "This Blueprint has been locked and can only be changed by an administrator");
//        }
//
//        // submit if the user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "Only Malley staff can edit Blueprint notes.");
//        return false;
//
//    }
//
//    /*
//     *      C H A N G E S  T O  T H E  C U S T O M E R
//     */
//
//
//    /**
//     * editing the blueprint's owner
//     * @param  User      $user      [description]
//     * @param  Blueprint $blueprint [description]
//     * @return [type]               [description]
//     */
//    public function editOwner( User $user, Blueprint $blueprint )
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "Only Malley staff can reassign Blueprints.");
//
//        return false;
//
//    }
//
//
//
//    /**
//     * updating the blueprint owner
//     * @param  User      $user      [description]
//     * @param  Blueprint $blueprint [description]
//     * @return [type]               [description]
//     */
//    public function updateOwner( User $user, Blueprint $blueprint )
//    {
//        // don't go further if the blueprint is locked
//        if ( $blueprint->is_locked )
//        {
//            abort(403, "This Blueprint has been locked and can only be changed by an administrator");
//        }
//
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "Only Malley staff can reassign Blueprints.");
//
//        return false;
//
//    }
//
//
//
//
//

    /**
     * [index description]
     * @param  User   $user [description]
     * @return [type]       [description]
     */
    public function index( User $user )
    {
        // user is malley staff
        if ($user->is_malley_staff) return true;

        abort(403, "You don't have permission to see all Blueprints.");

        return false;

    }

//
//    /**
//     * @param User $user
//     * @param Blueprint $blueprint
//     * @return bool
//     */
//    public function reset( User $user, Blueprint $blueprint ): bool
//    {
//        // don't go further if the blueprint is locked
//        if ( $blueprint->is_locked )
//        {
//            abort(403, "This Blueprint has been locked and can only be changed by an administrator");
//        }
//
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "You don't have permission to reset Blueprints.");
//
//        return false;
//
//    }
//
//
//    /**
//     * [destroy description]
//     * @param  User   $user [description]
//     * @return [type]       [description]
//     */
//    public function destroy( User $user, Blueprint $blueprint )
//    {
//        // don't go further if the blueprint is locked
//        if ( $blueprint->is_locked )
//        {
//            abort(403, "This Blueprint has been locked and can only be changed by an administrator. It may have been released to production and therefore should never be deleted.");
//        }
//
//        // user is malley staff
//        if ($user->is_admin && $user->is_malley_staff) return true;
//
//        abort(403, "Only an administrator can delete Blueprints.");
//
//        return false;
//
//    }
//
//
//    /**
//     * [showSheet description]
//     * @param  User      $user      [description]
//     * @param  Blueprint $blueprint [description]
//     * @return [type]               [description]
//     */
//    public function showSheet( User $user, Blueprint $blueprint )
//    {
//        // don't go further if the blueprint is locked
//        if ( $blueprint->is_locked )
//        {
//            abort(403, "This Blueprint has been locked and can't be modified except by an administrator. This may be because it has been released to production.");
//        }
//
//        // if ( $blueprint->status_id !== 0 )
//        // {
//        //     abort(403, "A Blueprint that is no longer in development can't be modified.");
//        // }
//
//        // they own the blueprint
//        if ($user->id === $blueprint->user_id) return true;
//
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        // user is of the same company
//        if ($user->company->id === $blueprint->user->company_id ) return true;
//
//        abort(403, "You don't have permission to edit this Blueprint.");
//
//        return false;
//    }
//
//
//    /**
//     * [costAnalysis description]
//     * @param  User   $user [description]
//     * @return [type]       [description]
//     */
//    public function costAnalysis(User $user)
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "You don't have permission to see cost analysis from Blueprints.");
//        return false;
//
//    }
//
//
//
//    /**
//     * [exitToSyspro description]
//     * @param  User   $user [description]
//     * @return [type]       [description]
//     */
//    public function exportToSyspro(User $user)
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "You don't have permission to export DAT files.");
//        return false;
//
//    }
//
//
//
//    /**
//     * [showLog description]
//     * @param  User   $user [description]
//     * @return [type]       [description]
//     */
//    public function showLog(User $user)
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "You don't have permission see logs.");
//        return false;
//
//    }
//
//
//
//    public function search(User $user)
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "You don't have permission to search Blueprints.");
//        return false;
//
//    }
//
//
//    public function quote(User $user, Blueprint $blueprint)
//    {
//        // user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "You don't have permission to see quotes for Blueprints.");
//        return false;
//
//    }
//
//
//    public function customConfiguration( User $user, Blueprint $blueprint )
//    {
//        // don't go further if the blueprint is locked
//        if ( $blueprint->is_locked )
//        {
//            abort(403, "This Blueprint has been locked and can't have custom configuration items added to it.");
//        }
//
//        // submit if the user is malley staff
//        if ($user->is_malley_staff) return true;
//
//        abort(403, "Only Malley staff can add custom items to Blueprints.");
//        return false;
//
//    }
//
//    public function changeStatus( User $user, Blueprint $blueprint)
//    {
//        if ( $user->is_malley_staff() )
//        {
//            return true;
//        }
//        else
//        {
//            abort(403, "Only Malley staff can change a Blueprint's status");
//        }
//        return false;
//    }


}
