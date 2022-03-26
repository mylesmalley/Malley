<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use App\Models\User;

class LoginController extends Controller
{


    public function alphabet( ): Response
    {
        return response()
            ->view('labour::login.alphabet');
    }

    public function letter( string $letter ): Response
    {
        return response()
            ->view('labour::login.letter');
    }
//
//    /**
//     * @param User|null $user
//     * @return View
//     */
//    public function loginForm( User $user = null ): View
//    {
//        Auth::logout();
//        return view('labour::login', [ 'user' => $user ]);
//    }
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
