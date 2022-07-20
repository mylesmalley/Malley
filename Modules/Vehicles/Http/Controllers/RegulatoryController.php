<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use App\Models\VehicleSerial;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
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
            $vehicle->update( $request->except(['CAAS_GVS_label_serial', 'o2_test_date', 'load_test_date']) );
        } catch( Exception $e )
        {
            Log::error("failed to update regulatory for vehicle $vehicle->id". $e);
        }

        if( $request->input('CAAS_GVS_label_serial') && $request->input('CAAS_GVS_label_serial') != null )
        {
            try {
                $vehicle->serials()
                    ->updateOrCreate(['key'=> strtoupper('CAAS_GVS_label_serial')],
                        ['value' => $request->input('CAAS_GVS_label_serial')
                    ]);
            } catch(Exception $e )
            {
                Log::error("failed to update CAAS details for vehicle $vehicle->id". $e);
            }
        }


        if( $request->input('o2_test_date') && $request->input('o2_test_date') != null )
        {
            try {
                VehicleDate::create([
                    'vehicle_id' => $vehicle->id,
                    'user_id' => Auth::user()->id,
                    'timestamp' => Carbon::create($request->input('o2_test_date'), 'America/Moncton')
                        ->toIso8601String(),
                    'name' => 'o2_test', // name of date field
                    'notes' => "from regulatory stickers page", // use preset notes if provided
                    'update_ford' => false,
                    'submitted_to_ford' => false,
                    'current' => 1,
                ]);
            } catch(Exception $e )
            {
                Log::error("failed to update o2_test details for vehicle $vehicle->id". $e);
            }
        }




        if( $request->input('load_test_date') && $request->input('load_test_date') != null )
        {
            try {
                VehicleDate::create([
                    'vehicle_id' => $vehicle->id,
                    'user_id' => Auth::user()->id,
                    'timestamp' => Carbon::create($request->input('load_test_date'), 'America/Moncton')
                        ->toIso8601String(),
                    'name' => 'load_test', // name of date field
                    'notes' => "from regulatory stickers page", // use preset notes if provided
                    'update_ford' => false,
                    'submitted_to_ford' => false,
                    'current' => 1,
                ]);
            } catch(Exception $e )
            {
                Log::error("failed to update load_test_date details for vehicle $vehicle->id". $e);
            }
        }

        Log::info("updatedxw regulatory details for vehicle $vehicle->id");
        return redirect()
            ->back();
    }



}
