<?php

namespace Modules\Blueprint\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Blueprint;
use App\Http\Controllers\Controller;


class HomeController extends Controller
{
    /**
     * @param User|null $user
     * @return View
     * @throws AuthorizationException
     */
    public function my_blueprints( User $user = null): View
    {
        $user = $user ?? Auth::user();

      //  $this->authorize( 'home', Blueprint::class );

        $title = ( $user ) ? str_possessive( $user->first_name ) . " Blueprints" : 'My Blueprints';

        $blueprints = $user
            ->blueprints()
            ->with( 'platform' )
            ->orderBy('id','DESC')
            ->paginate( 20 );

        return view('blueprint::my_blueprints', [
            'title' => $title,
            'blueprints' => $blueprints,
        ]);
    }




}
