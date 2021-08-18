<?php

namespace Modules\WorkOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;


/**
 * Class LineController
 * @package Modules\WorkOrder\Http\Controllers
 */
class DetailsController extends Controller
{

    /**
     * @param Request $request
     * @param WorkOrder $workOrder
     * @return RedirectResponse
     */
    public function updateVehicleDetails( Request $request, WorkOrder $workOrder) : RedirectResponse
    {
        $request->validate([
            'odometer' => 'nullable|integer',
        ]);
        $workOrder->odometer = $request->odometer;
        $workOrder->save();

        return redirect("/workOrders/{$workOrder->id}/show");
    }


    /**
     * @param Request $request
     * @param WorkOrder $workOrder
     * @return RedirectResponse
     */
    public function updateOrderDetails( Request $request, WorkOrder $workOrder) : RedirectResponse
    {
        $fields = [
            'date' => 'nullable|date',
            'title' => 'string|max:100',
            'number' => 'nullable|alpha_num|max:30',
            'quote_number' => 'nullable|alpha_num|max:30',
            'type' => 'nullable|alpha_num:max:10',
            'purchase_order_number' => 'nullable|alpha_num|max:30',
            'expected_chassis_delivery_date' => 'nullable|date',
            'expected_customer_pickup_date' => 'nullable|date',
        ];
        $request->validate( $fields );
        $workOrder->update( $request->only( array_keys($fields) ));
        $workOrder->save();

        return redirect("/workOrders/{$workOrder->id}/show");
    }



    /**
     * @param Request $request
     * @param WorkOrder $workOrder
     * @return RedirectResponse
     */
    public function updateFormatting( Request $request, WorkOrder $workOrder) : RedirectResponse
    {
        $fields = [
            'linecount' => 'nullable|numeric',
        ];
        $request->validate( $fields );
        $workOrder->update( $request->only( array_keys($fields) ));
        $workOrder->save();

        return redirect("/workOrders/{$workOrder->id}/show");
    }

    /**
     * @param Request $request
     * @param WorkOrder $workOrder
     * @return RedirectResponse
     */
    public function updateCustomer( Request $request, WorkOrder $workOrder) : RedirectResponse
    {

     //   dd( $request->all() );
        $fields = [
            'customer_name' => "nullable|string|max:100",
            'customer_address_1' => "nullable|string|max:100",
            'customer_address_2' => "nullable|string|max:100",
            'customer_city' => "nullable|string|max:50",
            'customer_province' => "nullable|string|max:50",
            'customer_postalcode' => "nullable|string|max:20",
            'customer_email' => "nullable|email|max:100",
            'customer_phone' => "nullable|string|max:20",
            'customer_contact' => "nullable|string|max:100",
        ];
        $request->validate( $fields );
        $workOrder->update( $request->only( array_keys($fields) ));
        $workOrder->save();

        return redirect("/workOrders/{$workOrder->id}/show");
    }
}
