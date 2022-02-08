<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class RegulatoryController extends Controller
{


    /**
     * @param Vehicle $vehicle
     * @return Response
     */
    public function edit( Vehicle $vehicle ): Response
    {
        return response()
            ->view('vehicles::info.regulatory',[
                'vehicle'=>$vehicle
            ]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update( Request $request, Vehicle $vehicle ): RedirectResponse
    {
        $vehicle->update( $request->all() );
        return redirect()->back();
    }



}
