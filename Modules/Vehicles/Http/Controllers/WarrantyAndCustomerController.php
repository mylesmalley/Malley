<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use View;
use Mpdf\Mpdf;


/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class WarrantyAndCustomerController extends Controller
{

    /**
     * @param Vehicle $vehicle
     */
    public function edit( Vehicle $vehicle )
    {
        return view('vehicles::warranty.warrantyAndCustomer', [ 'vehicle'=>$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update( Request $request,  Vehicle $vehicle ): RedirectResponse
    {

        $vehicle->update( $request->all() );
        $vehicle->save();

        return redirect('/vehicles/'.$vehicle->id );
    }


    /**
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function warrantyToggle( Vehicle $vehicle ): RedirectResponse
    {
        $vehicle->warranty_submitted = abs( $vehicle->warranty_submitted - 1);
        $vehicle->save();
        return redirect()->back();
    }


    public function warrantyCard( Vehicle $vehicle, bool $bi = true )
    {
//        return view('vehicles::warranty.warrantyCard', [
//            'vehicle' => $vehicle,
//        ]);



        $d = new Mpdf([
            'tempDir' => storage_path('tmp'),
//            'debug' => true,
        ]);

//        $d->writeHTML( View::make('Vehicles.warranty.en_card', [
//            'vehicle'=>$vehicle
//        ])
//        );

        if ( $bi === true )
        {
            $d->writeHTML( View::make('vehicles::warranty.bi_card', [
                'vehicle'=>$vehicle
                ])
            );
        }
        else
        {
            $d->writeHTML( View::make('vehicles::warranty.en_card', [
                'vehicle'=>$vehicle
            ])
            );
        }


        $d->output();
    }

}
