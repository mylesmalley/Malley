<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;


class HomeController extends Controller
{

    /**
     * @return View
     */
    public function home(): View
    {
        $user = Auth::user();
        return view('labour::home', ['user' => $user ]);
    }



}
