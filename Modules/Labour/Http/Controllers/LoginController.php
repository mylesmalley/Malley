<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\User;

class LoginController extends Controller
{

    /**
     * @param User|null $user
     * @return View
     */
    public function loginForm( User $user = null ): View
    {
        Auth::logout();
        return view('labour::login', [ 'user' => $user ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function submitLogin( Request $request ): RedirectResponse
    {

        $credentials = $request->only('id', 'password');

        if (Auth::attempt($credentials)) {
            return redirect()->route('labour.home');
        }

        return redirect()
            ->route('labour.login', $request->input('id'));

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('labour.login');
    }

}
