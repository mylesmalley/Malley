<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Carbon\Carbon;
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
    public function show( Vehicle $vehicle ): View
    {
        $vehicle->load('dates');
        return view('vehicles::dates.show', [ 'vehicle' => $vehicle ]);
    }


//
//    /**
//     * @param Vehicle $vehicle
//     * @return View
//     */
//    public function edit( Vehicle $vehicle ): View
//    {
//        return view('vehicles::dates', [ 'vehicle'=>$vehicle]);
//    }


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


//
//    public function migrate()
//    {
//
//
////        "date_in_service",
////        'date_next_renewal',
////        'date_chassis_manufactured',
////        'date_malley_finished_conversion', // added 2020-06-24
////        'date_warranty_registered', // added 2020-06-18
////        "date_warranty_expiry",
////        'date_of_purchase',
////        'date_leaving_malley_facility', // added 2021-06-03
//
//        $col = 'date_leaving_malley_facility';
//        $notes = "{$col}_notes";
//        $event = str_replace('date_', '', $col);
//
//        $vehicles = Vehicle::whereNotNull($col )
//            ->select(['id','user_id',$col,$notes])
//            ->get();
////        $recs2 = Vehicle::whereNotNull('date_arrival_notes')->get();
////
////        $recs3 = Vehicle::whereNotNull('date_arrival_notes')
////            ->whereNull('date_arrival')
////            ->get();
//
//        foreach( $vehicles as $v )
//        {
//            VehicleDate::create([
//                'vehicle_id' => $v->id,
//                'user_id' => $v->user_id,
//                'name' => $event, // name of date field
//                'notes' =>  $v->{$notes} ?? "", // use preset notes if provided
//                'update_ford' => 0,
//                //'update_ford' => strtoupper( $vehicle->make) === 'FORD',
//                'submitted_to_ford' => 0,
//                'timestamp' => Carbon::create( $v->{$col})->toIso8601String(),
//            ])->save();
//        }
//
//        dd( count( $vehicles ));
//
//       // dd( count($vehicles ), count($recs2), count($recs3));
//    }

}
