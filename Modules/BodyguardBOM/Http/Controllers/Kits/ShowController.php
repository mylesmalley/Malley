<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Modules\BodyguardBOM\Models\Category;
use Modules\BodyguardBOM\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class ShowController extends Controller
{

    /**
     * @return Response
     */
    public function show( Part $part ) : Response
    {
        $part->load('categories');

        return response()->view('bodyguardbom::parts.show', [
            'part' => $part,
            'categories' => $part->categories
        ]);
    }


}


