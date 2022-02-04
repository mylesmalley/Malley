<?php

namespace Modules\Vehicles\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use App\Models\WarrantyClaim;
use App\Models\WorkOrder;
use App\Models\WorkOrderLine;
use Illuminate\Support\Facades\Auth;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class WorkOrderFromWarrantyClaimController extends Controller
{


    public function create( WarrantyClaim $claim )
    {
        $vehicle = $claim->vehicle;

        $workOrder = WorkOrder::create([
            'date' => date('Y-m-d'),
            'type' => "WORK ORDER",
            'odometer' => $claim->mileage,
            'vehicle_id' => $vehicle->id,
            'customer_name' => $claim->first_name . " " . $claim->last_name . ', ' . $claim->organization,
            'customer_address_1' => $vehicle->customer_address_1,
            'customer_address_2' => $vehicle->customer_address_2,
            'customer_city' => $vehicle->customer_city,
            'customer_province' => $vehicle->customer_province,
            'customer_postalcode' => $vehicle->customer_postalcode,
            'customer_phone' => $vehicle->customer_phone,
            'customer_email' => $vehicle->customer_email,
            'user_id' => Auth::user()->id ?? 3,
        ]);

      //  dd($workOrder);

     //   $workOrder->save();

        WorkOrderLine::create([
            'description' => "Customer complaint: ",
            'work_order_id' => $workOrder->id,
            'order' => 1,
        ]);
        //$line->save();

        WorkOrderLine::create([
            'description' => $claim->issue,
            'work_order_id' => $workOrder->id,
            'order' => 2,
        ]);
        //$line->save();




        WorkOrderLine::create([
            'description' => "Notes from Warranty admin: ",
            'work_order_id' => $workOrder->id,
            'order' => 3,
        ]);
     //   $line->save();

         WorkOrderLine::create([
            'description' => $claim->notes,
            'work_order_id' => $workOrder->id,
            'order' => 4,
        ]);
     //   $line->save();


     //   dd($claim,  $workOrder );

        return redirect('/workOrders/'.$workOrder->id.'/show');
    }




}
