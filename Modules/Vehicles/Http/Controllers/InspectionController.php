<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Inspection;use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class InspectionController extends Controller
{


    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function show( Vehicle $vehicle ): View
    {
        return view('vehicles::inspections.show', [ 'vehicle'=>$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store( Request $request, Vehicle $vehicle )
    {
        $request->validate([
            "description" => "required|string|max:255"
        ]);

        $inspection = new Inspection( $request->all() );
        $inspection->vin = $vehicle->vin;
        $inspection->date_entered = date('Y-m-d');

        $vehicle->inspections()->save( $inspection );

        return redirect()->back();
    }



    /**
     * @param Vehicle $vehicle
     * @param Inspection $inspection
     * @return View
     */
    public function edit( Vehicle $vehicle, Inspection $inspection ): View
    {
        return view('vehicles::inspections.edit',[
           'vehicle' => $vehicle,
           'inspection' => $inspection,
        ]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @param Inspection $inspection
     * @return RedirectResponse
     */
    public function update( Request $request, Vehicle $vehicle, Inspection $inspection ) : RedirectResponse
    {
        $inspection->update( $request->all() );
        return redirect('/vehicles/'.$vehicle->id.'/inspections');
    }


    /**
     * @param Vehicle $vehicle
     * @param Inspection $inspection
     * @return RedirectResponse
     * @throws Exception
     */
    public function delete( Vehicle $vehicle, Inspection $inspection ): RedirectResponse
    {
        $inspection->delete();
        return redirect('/vehicles/'.$vehicle->id.'/inspections');
    }


}
