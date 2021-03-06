<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use DateTime;
use DateTimeZone;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Response;

use Illuminate\Database\Query\JoinClause;



/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class ReportsController extends Controller
{
    /**
     * @return Response
     */
    public function productionBuildListReport(): Response
    {
        $records = Vehicle::select(['vehicles.id', 'computed_vehicle_number'
            ,'malley_number',
            'customer_number','refurb_number',
            'company_id','vin','work_order',

            'delivery.timestamp as date_delivery',
            'lease_expiry.timestamp AS date_lease_expiry_of_refurb',

            'make','model','year',
            'customer_name' ])
            // grab the first work order number
            //     ->addSelect(DB::Raw("RIGHT(LEFT(work_order,8), 4) AS unit_number"))
            ->where('work_order','like','A00%')
            ->orWhere('work_order','like', 'AAL%')
            ->with('dealer')

            ->leftjoin('vehicle_dates as delivery', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'delivery.vehicle_id')
                    ->where('delivery.name','delivery')
                    ->where('delivery.current', '=', true);
            })
            // bring in the next renewal
            ->leftjoin('vehicle_dates as lease_expiry', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'lease_expiry.vehicle_id')
                    ->where('lease_expiry.name','lease_expiry_of_refurb')
                    ->where('lease_expiry.current', '=', true);

            })



            ->orderBy('computed_vehicle_number','DESC')
            ->paginate(100);



        return response()
            ->view('vehicles::reports.productionBuildList', [
                'rows' => $records,
            ]);
    }


    /**
     * @param int $date
     * @return Response
     */
    public function transitionReport( int $date = 2020 ): Response
    {

        $start = new Carbon(new DateTime("{$date}-04-01"),
            new DateTimeZone('America/Moncton')); // equivalent to previous instance

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
                    ->where('in_service.current', '=', true)
                    ->where('in_service.name','in_service');
            })
            // bring in the next renewal
            ->join('vehicle_dates as next_renewal', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'next_renewal.vehicle_id')
                    ->where('next_renewal.current', '=', true)

                ->where('next_renewal.name','next_renewal');
            })
            ->where('customer_name', 'like', '%New Brunswick%')
            ->orderBy('date_in_service')
            ->get();


        return response()
                ->view('vehicles::reports.transitionReport', [
            'rows' => $records,
            'start' => $start,
            'end' => $end
        ]);
    }


    /**
     * @return Response
     */
    public function USChassisInCanadaReport(): Response
    {

        $records = Vehicle::select([
                'vehicles.id',
                'work_order',
                'vin',
                'customer_name',
                'make', 'model', 'year', 'drive',
                'entry_to_canada.timestamp as date_entry_to_canada',
            ])

            ->whereHas('dates', function( Builder $builder ){

                $builder->where('name', '=', 'entry_to_canada');

            })
            ->whereDoesntHave('dates', function( Builder $builder ){

                $builder->where('name', '=', 'exit_from_canada');

            })
            ->leftjoin('vehicle_dates as entry_to_canada', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'entry_to_canada.vehicle_id')
                    ->where('entry_to_canada.current', '=', true)
                    ->where('entry_to_canada.name','entry_to_canada');
            })
            ->leftjoin('vehicle_dates as exit_from_canada', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'exit_from_canada.vehicle_id')
                    ->where('exit_from_canada.current', '=', true)
                    ->where('exit_from_canada.name','exit_from_canada');
            })
            ->paginate(30);

        return response()
            ->view('vehicles::reports.USChassisInCanadaReport', [
                'rows' => $records,
        ]);
    }



    /**
     * Response
     */
    public function atThorntonOrYork(): Response
    {

        $records = Vehicle::select([
            'vehicles.id',
            'work_order',
            'vin',
            'customer_name',
            'make', 'model', 'year', 'drive',
            'at_york_or_thornton.timestamp as date_at_york_or_thornton',
        ])

            ->whereHas('dates', function( Builder $builder ){

            $builder->where('name', '=', 'at_york_or_thornton');

            })
            ->whereDoesntHave('dates', function( Builder $builder ){

                $builder->where('name', '=', 'exit_from_canada');

            })
            ->leftjoin('vehicle_dates as at_york_or_thornton', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'at_york_or_thornton.vehicle_id')
                    ->where('at_york_or_thornton.current', '=', true)

                    ->where('at_york_or_thornton.name','at_york_or_thornton');
            })
            ->leftjoin('vehicle_dates as exit_from_canada', function(JoinClause $join){
                $join->on('vehicles.id', '=', 'exit_from_canada.vehicle_id')
                    ->where('exit_from_canada.current', '=', true)

                    ->where('exit_from_canada.name','exit_from_canada');
            })
            ->orderBy('date_at_york_or_thornton','asc')
            ->paginate(20);


        return response()
            ->view('vehicles::reports.atThorntonOrYork', [
                'rows' => $records,
            ]);
    }
}
