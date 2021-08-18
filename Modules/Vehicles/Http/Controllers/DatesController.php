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
class DatesController extends Controller
{

    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function edit( Vehicle $vehicle ): View
    {
        return view('vehicles::dates', [ 'vehicle'=>$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update( Request $request,  Vehicle $vehicle ): RedirectResponse
    {
        // repeat the same validatin on every value
        $validations = array_fill_keys( Vehicle::dateFields(), 'nullable|string|max:50' );

    //    dd( $request->all() );

        $request->validate( $validations );

     //   $raw = $request->only( Vehicle::serialFields() );
        $raw = $request->all();

     //   $uc = array_map('strtoupper', $raw);
        $vehicle->update( $raw );
        $vehicle->save();

        return redirect('/vehicles/'.$vehicle->id );
    }

}
