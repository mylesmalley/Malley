<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use Illuminate\Routing\Controller;
use Illuminate\Http\Response;


class HomeController extends Controller
{

    /**
     * @return Response
     */
    public function home(): Response
    {
        return response()
            ->view('labour::manage_labour.home' );
    }



}
