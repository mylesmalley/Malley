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

        if ( ! Auth::user()->is_malley_staff() )
        {
            if ($user->company_id === Auth::user()->company_id)
                abort("You can only see your or your coworker's Blueprints");
        }

        $title = ( Auth::user() !== $user )
            ? str_possessive( $user->first_name ) . " Blueprints"
            : 'My Blueprints';

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





    public function testroute()
    {
            $this->authorize('see_user_blueprints', User::find(15));
//       dd( $this->authorize('test2', User::find(2)) );

       // $this->authorizeForUser( Auth::user(), 'letIn', [User::class]);
//        request()->user()->can('letIn'. User::class );
        dd(Auth::user(), 'route');
    }

}
