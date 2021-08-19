<?php

namespace Modules\Blueprint\Http\Controllers;

use Illuminate\View\View;
use App\Models\User;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * @param User|null $user
     * @return View
     */
    public function my_blueprints( User $user = null): View
    {
        $title = ( $user ) ? str_possessive( $user->first_name ) . " Blueprints" : 'My Blueprints';

        return view('blueprint::my_blueprints', [
            'title' => $title,
        ]);
    }




}
