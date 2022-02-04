<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class SerialsController extends Controller
{

    public function show( Vehicle $vehicle )
    {

        return response()->view('vehicles::serials.show', [
            'vehicle' => $vehicle->load('serials'),
        ]);
    }

    /**
     * @param Vehicle $vehicle
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Vehicle $vehicle, Request $request ): RedirectResponse
    {
        $request->validate([
            'key' => 'required|string|max:50',
            'value' => 'required|string|max:100',
        ]);

        $vehicle->serials()->updateOrCreate([
            'key' => strtoupper($request->input('key'))
        ],
            [
            'value' => $request->input('value'),
        ]);

        return redirect()->back();
    }



//    /**
//     * @param Vehicle $vehicle
//     * @return View
//     */
//    public function edit( Vehicle $vehicle ): View
//    {
//        return view('vehicles::serials', [ 'vehicle'=>$vehicle]);
//    }
//
//
//    /**
//     * @param Request $request
//     * @param Vehicle $vehicle
//     * @return RedirectResponse
//     */
//    public function update( Request $request,  Vehicle $vehicle ): RedirectResponse
//    {
//        // repeat the same validatin on every value
//        $validations = array_fill_keys( Vehicle::serialFields(), 'nullable|string' );
//
//        $request->validate( $validations );
//
//        $raw = $request->only( Vehicle::serialFields() );
//
//        $uc = array_map('strtoupper', $raw);
//        $vehicle->update( $uc );
//        $vehicle->save();
//
//        return redirect('/vehicles/'.$vehicle->id );
//    }

}
