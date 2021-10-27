<?php

namespace Modules\Blueprint\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * Index page of a user's blueprints
     *
     * @param User|null $user
     * @return View
     * @throws AuthorizationException
     */
    public function my_blueprints( User $user = null): View
    {
        $user = $user ?? Auth::user();

        $this->authorize('see_user_blueprints', $user);

        $title = ( Auth::user() !== $user )
            ? str_possessive( $user->first_name ) . " Blueprints"
            : 'My Blueprints';

        $blueprints = $user
            ->blueprints()
            // limit non-admin users to only edit transit mobility blueprints for now
                //TODO
//            ->when( ! Auth::user()->hasRole('super_admin'), function($query) {
//                return $query->whereIn('base_van_id',[ 11 ] );
//            })
            ->whereIn('base_van_id',[ 11, 14, 12, 31 ] )
            ->with( 'platform' )
            ->orderBy('id','DESC')
            ->paginate( 20 );

        return view('blueprint::my_blueprints', [
            'title' => $title,
            'blueprints' => $blueprints,
        ]);
    }



}
