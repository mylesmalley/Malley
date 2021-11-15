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
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('dates');

        return view('vehicles::dates.show', [
            'vehicle' => $vehicle
        ]);
    }


    /**
     * @param Vehicle $vehicle
     * @param VehicleDate $date
     * @return View
     */
    public function edit(Vehicle $vehicle, VehicleDate $date): View
    {
        return view('vehicles::dates.edit', [
            'vehicle' => $vehicle,
            'date' => $date
        ]);

    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @param VehicleDate $date
     * @return RedirectResponse
     */
    public function update(Request $request, Vehicle $vehicle, VehicleDate $date): RedirectResponse
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'notes' => 'nullable|string|max:255',
            'name' => 'required|string',
        ]);

        $ts = Carbon::create($request->input('date') . ' ' . $request->input('time'), 'America/Moncton')
            ->toIso8601String();


        $date->update([
            'current' => false,
        ]);
        $date->save();

        VehicleDate::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => Auth::user()->id,
            'timestamp' => $ts,
            'name' => $request->input('name'), // name of date field
            'notes' => $request->input('notes') ?? "", // use preset notes if provided
            'update_ford' => strtoupper($vehicle->make) === 'FORD'
                && in_array($request->input('name'),
                    VehicleDate::ford_milestone()),
            'submitted_to_ford' => 0,
            'current' => 1,
        ])->save();

        return redirect()->route('vehicle.dates', [$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store(Request $request, Vehicle $vehicle): RedirectResponse
    {
        $request->validate([
            'date' => 'required|date',
            'time' => 'required|string',
            'notes' => 'nullable|string|max:255',
            'name' => 'required|string',
        ]);

        $ts = Carbon::create($request->input('date') . ' '
            . $request->input('time'), 'America/Moncton')
            ->toIso8601String();



        // turn off any duplicates
        VehicleDate::where([
            'vehicle_id' => $vehicle->id,
            'name' => $request->input('name')
        ])->update([
            'current' => false,
        ]);


        VehicleDate::create([
            'vehicle_id' => $vehicle->id,
            'user_id' => Auth::user()->id,
            'timestamp' => $ts,
            'name' => $request->input('name'), // name of date field
            'notes' => $request->input('notes') ?? "", // use preset notes if provided
            'update_ford' => strtoupper($vehicle->make) === 'FORD'
                && in_array($request->input('name'),
                    VehicleDate::ford_milestone()),
            'submitted_to_ford' => 0,
            'current' => 1,
        ])->save();

    //    dd( $request->input('date'), $request->input('time'), $ts );


        return redirect()->route('vehicle.dates', [$vehicle]);
    }


    /**
     * @param Vehicle $vehicle
     * @param VehicleDate $date
     * @return RedirectResponse
     */
    public function retire( Vehicle $vehicle, VehicleDate $date ): RedirectResponse
    {
        $date->update([
            'current' => false,
        ]);
        return redirect()
            ->route('vehicle.dates', [$vehicle]);
    }


}
