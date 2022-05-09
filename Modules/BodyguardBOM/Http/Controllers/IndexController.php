<?php

namespace Modules\BodyguardBOM\Http\Controllers;

use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use App\Models\BG\Category;

class IndexController extends Controller
{
    /**
     * @param Category|null $category
     * @return Response
     */
    public function show( Category $category = null )
    {
        dd( $category );

        return response()->view('bodyguardbom::show');
    }

}
