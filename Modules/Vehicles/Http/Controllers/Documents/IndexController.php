<?php

namespace Modules\Vehicles\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class IndexController extends Controller
{
    public function show( Vehicle $vehicle )
    {
        return view('vehicles::documents.index',
        [
            'vehicle' => $vehicle,
        ]);
    }

}
