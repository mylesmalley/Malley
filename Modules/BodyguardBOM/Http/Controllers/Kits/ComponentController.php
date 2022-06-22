<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Modules\BodyguardBOM\Models\Kit;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;

class ComponentController extends Controller
{

    /**
     * @param Kit $kit
     * @return Response
     */
    public function show( Kit $kit ) : Response
    {
        return response()->view('bodyguardbom::kits.components', [
            'kit' => $kit,
        ]);
    }


}


