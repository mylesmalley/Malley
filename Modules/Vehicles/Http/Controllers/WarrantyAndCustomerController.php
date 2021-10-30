<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
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

        $vehicle->update( $request->except([
            'date_of_purchase',
            'date_warranty_registered',
            'date_warranty_expiry'
        ]) );
        $vehicle->save();


        if ( $request->input('date_of_purchase') )
        {
            VehicleDate::where('vehicle_id', '=', $vehicle->id)
                ->where('name', '=', 'of_purchase')
                ->update([
                    'current' => 0
                ]);

            VehicleDate::create([
                'vehicle_id' => $vehicle->id,
                'user_id' => Auth::user()->id,
                'timestamp' => Carbon::createFromDate( $request->input('date_of_purchase') )->toIso8601String(),
                'name' => "of_purchase", // name of date field
                'notes' => "", // use preset notes if provided
                'update_ford' => 0,
                'submitted_to_ford' => 0,
                'current' => 1,
            ])->save();
        }


        if ( $request->input('date_warranty_registered') )
        {
            VehicleDate::where('vehicle_id', '=', $vehicle->id)
                ->where('name', '=', 'warranty_registered')
                ->update([
                    'current' => 0
                ]);

            VehicleDate::create([
                'vehicle_id' => $vehicle->id,
                'user_id' => Auth::user()->id,
                'timestamp' => Carbon::createFromDate( $request->input('date_warranty_registered') )->toIso8601String(),
                'name' => "warranty_registered", // name of date field
                'notes' => "", // use preset notes if provided
                'update_ford' => 0,
                'submitted_to_ford' => 0,
                'current' => 1,
            ])->save();
        }



        if ( $request->input('date_warranty_expiry') )
        {
            VehicleDate::where('vehicle_id', '=', $vehicle->id)
                ->where('name', '=', 'warranty_expiry')
                ->update([
                    'current' => 0
                ]);

            VehicleDate::create([
                'vehicle_id' => $vehicle->id,
                'user_id' => Auth::user()->id,
                'timestamp' => Carbon::createFromDate( $request->input('date_warranty_expiry') )->toIso8601String(),
                'name' => "warranty_expiry", // name of date field
                'notes' => "", // use preset notes if provided
                'update_ford' => 0,
                'submitted_to_ford' => 0,
                'current' => 1,
            ])->save();
        }




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
