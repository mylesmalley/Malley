<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Illuminate\Support\Facades\Auth;
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


        $vehicle->update( $raw );
        $vehicle->save();





        foreach( $vehicle->getChanges() as $k => $v )
        {
            if ( in_array( $k, Vehicle::dateFields() ))
            {
                VehicleDate::create([
                    'vehicle_id' => $vehicle->id,
                    'user_id' => Auth::user()->id,
                    'event_name' => $k, // name of date field
                    'notes' =>  $request->{$k} ?? "notes", // use preset notes if provided
                    'update_ford' => strtoupper( $vehicle->make) === 'FORD',
                    'submitted_to_ford' => 0,
                ])->save();
            }
        }



        return redirect('/vehicles/'.$vehicle->id );
    }

}
