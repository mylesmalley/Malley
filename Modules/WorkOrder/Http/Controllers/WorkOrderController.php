<?php

namespace Modules\WorkOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class WorkOrderController extends Controller
{
    public function show( WorkOrder $workOrder, string $mode = "show", int $value =null )
    {
        return view('workorder::show', [
            'workOrder'=>$workOrder,
            'mode' => $mode,
            'value' => $value ?? null
        ]);
    }


    public function create( Request $request )
    {
        $request->validate(['vehicle_id' => "required|int"]);

        $vehicle = Vehicle::find($request->vehicle_id);

        $workOrder = WorkOrder::create([
            'vehicle_id' => $request->vehicle_id,
            'customer_name' => $vehicle->customer_name,
            'customer_address_1' => $vehicle->customer_address_1,
            'customer_address_2' => $vehicle->customer_address_2,
            'customer_city' => $vehicle->customer_city,
            'customer_province' => $vehicle->customer_province,
            'customer_postalcode' => $vehicle->customer_postalcode,
            'customer_phone' => $vehicle->customer_phone,
            'customer_email' => $vehicle->customer_email,
            'user_id' => Auth::user()->id ?? 3,
        ]);

       $workOrder->save();

        return redirect("workOrders/{$workOrder->id}/show");
    }
}
