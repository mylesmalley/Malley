<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;
use Modules\Vehicles\Jobs\FordMilestoneUpdate;


/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class DatesController extends Controller
{

    /**
     * shows a nice list of existing date records that are active.
     *
     * @param Vehicle $vehicle
     * @return Response
     */
    public function show(Vehicle $vehicle): Response
    {
        $vehicle->load('dates');

        return response()->view('vehicles::dates.show', [
            'vehicle' => $vehicle
        ]);
    }


    /**
     * returns a form to 'edit' a record, but actually creates a new one with the existing data as a starting point.
     *
     * @param Vehicle $vehicle
     * @param VehicleDate $date
     * @return Response
     */
    public function edit(Vehicle $vehicle, VehicleDate $date): Response
    {
        return response()->view('vehicles::dates.edit', [
            'vehicle' => $vehicle,
            'date' => $date
        ]);

    }


    /**
     * when an existing record is being updated, we actually create a new one and then mark the original as out of date
     *
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

        Log::info("Retired date $date->id for Vehicle $vehicle->id");

        $date->update([
            'current' => false,
        ]);
        $date->save();

        $this->create_vehicle_date_record($vehicle, $ts, $request);

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


        $this->create_vehicle_date_record($vehicle, $ts, $request);

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




    /**
     * extracted duplicate code chunk from other functions on this class
     *
     * @param Vehicle $vehicle
     * @param string $ts
     * @param Request $request
     */
    private function create_vehicle_date_record(Vehicle $vehicle, string $ts, Request $request): void
    {
        $vehicleDate = VehicleDate::create([
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
        ]);

        Log::info("Created date $vehicleDate->id for Vehicle $vehicle->id");

        if ( $vehicleDate->update_ford )
        {
            FordMilestoneUpdate::dispatch( $vehicleDate );
        }

    }

}
