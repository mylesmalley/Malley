<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;


class HomeController extends Controller
{

    /**
     * @return Response
     */
    public function home(): Response
    {
        $user = Auth::user();
        return response()
            ->view('labour::home', ['user' => $user ]);
    }



}
