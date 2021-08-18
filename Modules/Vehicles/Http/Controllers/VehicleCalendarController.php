<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class VehicleCalendarController extends Controller
{
    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return false|string
     */
    public function get( Request $request, Vehicle $vehicle )
    {
        $dates = $vehicle->dates;
        $formatted = [];
        foreach( $dates as $date )
        {
            $formatted[] = $date->toFullCalendarEvent();
        }


        return json_encode( $formatted );

    }


    public function create( Vehicle $vehicle )
    {
        return view('vehicles::dates.create', ['vehicle' => $vehicle]);
    }


    public function store( Request $request, Vehicle $vehicle )
    {
        $cols = [
            'start' => 'required|string',
            'notes' => 'nullable|string',
            'title' => 'required|string|max:50',
            'user_id' => 'required|int',
        ];

        $request->validate( $cols );

        $date = new VehicleDate( $request->only( array_keys($cols) ));



        $vehicle->dates()->save( $date );

        return redirect('/vehicles/'.$vehicle->id );
    }


    public function edit( VehicleDate $vehicleDate )
    {
        return view('vehicles::dates.edit', ['date' => $vehicleDate]);
    }

    public function update( Request $request, VehicleDate $vehicleDate )
    {
        $cols = [
            'start' => 'string',
            'notes' => 'nullable|string',
            'title' => 'required|string|max:50',
        ];

        $request->validate( $cols );

     //   dd( $request->all());

        $vehicleDate->update( $request->only( array_keys($cols) ));

        return redirect('/vehicles/'.$vehicleDate->vehicle_id );
    }
}
