<?php

namespace Modules\Time\Http\Controllers;

use App\Models\User;
use App\Models\Staff;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Inertia\Inertia;

class LoginController extends Controller
{



    public function login()
    {
        Auth::logout();

        return Inertia::render('Pages/Alphabet', []);
    }

    public function letter( string $letter )
    {
        Auth::logout();

        return Inertia::render('Pages/StaffByLetter', [
            'staff' => User::select('id', 'first_name', 'last_name')
                ->where('last_name', 'like', strtoupper($letter).'%')
                ->get()
        ]);
    }


    public function keypad( User $user )
    {
        Auth::logout();

        return Inertia::render('Pages/KeyPad', [
            'user' => $user,
        ]);
    }


    public function submitLogin( Request $request )
    {

        $credentials = $request->only('id', 'email', 'password');

        Auth::login( User::find( $request->input('id')) );

//        if (Auth::attempt($credentials)) {
//                $user = Auth::user();
                    return redirect( '/time/home' );
//
//        }
//
//        else
//
//            dd( "xxxxxx");

    }



}
