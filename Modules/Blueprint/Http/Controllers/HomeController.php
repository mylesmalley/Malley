<?php

namespace Modules\Blueprint\Http\Controllers;

use \Illuminate\View\View;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{
    /**
     * @return View
     */
    public function my_blueprints(): View
    {
        return view('blueprint::my_blueprints');
    }




}
