<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleSerial;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Log;


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

        $caas = VehicleSerial::where('vehicle_id', '=',$vehicle->id)
                ->where('key','=', strtoupper('CAAS_GVS_label_serial'))
                ->first();

        return response()
            ->view('vehicles::info.regulatory',[
                'vehicle'=> $vehicle,
                'caas' => $caas,
            ]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update( Request $request, Vehicle $vehicle ): RedirectResponse
    {

        try {
            $vehicle->update( $request->except(['CAAS_GVS_label_serial']) );
        } catch( \Exception $e )
        {
            Log::error("failed to update CAAS serial for vehicle $vehicle->id". $e);
        }

        try {
            $vehicle->serials()
                ->updateOrCreate(['key'=> strtoupper('CAAS_GVS_label_serial')],
                    ['value' => $request->input('CAAS_GVS_label_serial')
                ]);
        } catch(\Exception $e )
        {
            Log::error("failed to update regulatory details for vehicle $vehicle->id". $e);
        }


        Log::info("updatedxw regulatory details for vehicle $vehicle->id");
        return redirect()
            ->back();
    }



}
