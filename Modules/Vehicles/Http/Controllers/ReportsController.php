<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;
/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class ReportsController extends Controller
{
    /**
     * @return View
     */
    public function productionBuildListReport(): View
    {
        $records = Vehicle::select(['id', 'computed_vehicle_number'
            ,'malley_number',
            'customer_number','refurb_number',
            'company_id','vin','work_order','date_delivery',
            'date_lease_expiry_of_refurb','make','model','year',
            'customer_name' ])
            // grab the first work order number
       //     ->addSelect(DB::Raw("RIGHT(LEFT(work_order,8), 4) AS unit_number"))
        ->where('work_order','like','A00%')
            ->orWhere('work_order','like', 'AAL%')
             ->with('dealer')
            ->orderBy('computed_vehicle_number','DESC')
            ->paginate(100);


        return view('vehicles::reports.productionBuildList', [
                'rows' => $records,
            ]);
    }



    /**
     * @return View
     */
    public function transitionReport( $date = 2020 ): View
    {

        $start = new \Carbon\Carbon(new \DateTime("{$date}-04-01"),
            new \DateTimeZone('America/Moncton')); // equivalent to previous instance

        $start->addDay();
        $end = $start->copy()->addYear();

    //  dd( $start );

       // select * from vehicles where date_next_renewal IS NOT NULL AND date_in_service IS NOT NULL

        $records = Vehicle::where('date_in_service','>=', $start)
            ->where('date_in_service', '<',  $end)
            ->where('customer_name', 'like', '%New Brunswick%')
            ->orderBy('date_in_service')
            ->get();

        return view('vehicles::reports.transitionReport', [
            'rows' => $records,
            'start' => $start,
            'end' => $end
        ]);
    }



    public function USChassisInCanadaReport()
    {
        $records = Vehicle::where('date_exit_from_canada', null)
            ->where('date_entry_to_canada', '!=', '')

            ->orderBy('date_entry_to_canada','asc')
            ->paginate(30);


        return view('vehicles::reports.USChassisInCanadaReport', [
            'rows' => $records,
        ]);
    }



    public function atThorntonOrYork()
    {
        $records = Vehicle::where('date_exit_from_canada', null)
            ->where('date_at_york_or_thornton', '!=', '')

            ->orderBy('date_at_york_or_thornton','asc')
            ->paginate(20);
    //    "date_at_york_or_thornton",
   //     "date_arrived_at_york_or_thornton_notes",

        return view('vehicles::reports.atThorntonOrYork', [
            'rows' => $records,
        ]);
    }
}
