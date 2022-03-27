<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;

class LoginController extends Controller
{

    /**
     * @return Response
     */
    public function alphabet( ): Response
    {
        Auth::logout();

        return response()
            ->view('labour::login.alphabet');
    }

    /**
     * @param string $letter
     * @return Response
     */
    public function letter( string $letter = "A" ): Response
    {
        Auth::logout();

        $users = User::where('is_enabled', true)
            ->role('labour')
            ->where('last_name', 'like', $letter . "%" )
            ->select('first_name','last_name','id')
            ->get();

        return response()
            ->view('labour::login.letter', ['users' => $users ]);
    }



//
    /**
     * @param User|null $user
     * @return RedirectResponse|Response
     */
    public function login_form( User $user = null ): RedirectResponse|Response
    {
        Auth::logout();
        if (!$user) return redirect()->route('labour.login.alphabet');
        return response()
            ->view('labour::login.login-form', [ 'user' => $user ]);
    }
//
//
//    /**
//     * @param Request $request
//     * @return RedirectResponse
//     */
//    public function submitLogin( Request $request ): RedirectResponse
//    {
//
//        $credentials = $request->only('id', 'password');
//
//        if (Auth::attempt($credentials)) {
//            return redirect()->route('labour.home');
//        }
//
//        return redirect()
//            ->route('labour.login', $request->input('id'));
//
//    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('labour.login');
    }

}
