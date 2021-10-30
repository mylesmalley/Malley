<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Query\JoinClause;
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
     *
     * @param int $date
     * @return View
     */
    public function transitionReport( int $date = 2020 ): View
    {

        $start = new Carbon(new \DateTime("{$date}-04-01"),
            new \DateTimeZone('America/Moncton')); // equivalent to previous instance

        $start->addDay();
        $end = $start->copy()->addYear();


        $records = Vehicle::whereHas('dates', function( Builder $query ) use ($start, $end) {
            $query->where('name','=','in_service')
                ->where('timestamp', '>=', $start )
                ->where('timestamp', '<=', $end );
            })->select(['vehicles.id',
                'vin',
                'customer_name',
                'in_service.timestamp AS date_in_service', // to prevent overlap.
                'next_renewal.timestamp AS date_next_renewal', // to prevent overlap
                'malley_number',
                'customer_number'
            ])
            // rename the in_service date join so that it doesn't overlap
            ->join('vehicle_dates as in_service', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'in_service.vehicle_id')
                    ->where('in_service.name','in_service');
            })
            // bring in the next renewal
            ->join('vehicle_dates as next_renewal', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'next_renewal.vehicle_id')
                    ->where('next_renewal.name','next_renewal');
            })
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
