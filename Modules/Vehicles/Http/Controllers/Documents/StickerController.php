<?php

namespace Modules\Vehicles\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;

/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class StickerController extends Controller
{
    /**
     * @param Vehicle $vehicle
     * @param string|null $location
     * @return View
     */
    public function show(Vehicle $vehicle, string $location = null): View
    {
        return view('vehicles::stickers.show', [
                'vehicle' => $vehicle,
                'location' => $location,
            ]);
    }


}
