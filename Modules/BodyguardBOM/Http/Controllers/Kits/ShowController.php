<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Modules\BodyguardBOM\Models\Kit;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ShowController extends Controller
{

    /**
     * @param Kit $kit
     * @return Response
     */
    public function show( Kit $kit ) : Response
    {
        $kit->load('categories');

        return response()->view('bodyguardbom::kits.show', [
            'kit' => $kit,
          //  'categories' => $kit->categories
        ]);
    }


}


