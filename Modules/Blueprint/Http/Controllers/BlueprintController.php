<?php

namespace Modules\Blueprint\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Routing\Controller;

class BlueprintController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function public_index()
    {
        dd(" public view only ");
      //  return view('blueprint::index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function private_index()
    {
        dd(" PRIVATE view only ");

//        return view('blueprint::create');
    }



}
