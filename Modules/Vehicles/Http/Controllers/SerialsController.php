<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class SerialsController extends Controller
{

    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function edit( Vehicle $vehicle ): View
    {
        return view('vehicles::serials', [ 'vehicle'=>$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update( Request $request,  Vehicle $vehicle ): RedirectResponse
    {
        // repeat the same validatin on every value
        $validations = array_fill_keys( Vehicle::serialFields(), 'nullable|string' );

        $request->validate( $validations );

        $raw = $request->only( Vehicle::serialFields() );

        $uc = array_map('strtoupper', $raw);
        $vehicle->update( $uc );
        $vehicle->save();

        return redirect('/vehicles/'.$vehicle->id );
    }

}
