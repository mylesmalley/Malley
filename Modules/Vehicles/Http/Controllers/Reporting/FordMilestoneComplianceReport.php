<?php

namespace Modules\Vehicles\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class FordMilestoneComplianceReport extends Controller
{
    /**
     * Vehicles added to the database on or after 2021-06-01
        that have a VIN assigned to them
        that have an arrival date set
        that do not have a compound exit date set
     *
     * @param Request $request
     * @return Response
     */
    public function view( Request $request ): Response
    {
        $request->validate([
           'hide_not_arrived' => [
                'sometimes',
                Rule::in(['true','false']),
            ],
           'hide_departed'  => [
               'sometimes',
               Rule::in(['true','false']),
           ],
        ]);
       // ?hide_departed=true&hide_not_arrived=true

       // $hide_not_arrived = $request->input('hide_not_arrived') ?? false;
        $hide_not_arrived = !$request->exists('show_not_here');
        $hide_departed = !$request->exists('show_departed');
//        $hide_departed = $request->exists('hide_departed');


        $vehicles = Vehicle::select([
                'id','vin','work_order','malley_number','customer_number',
                'make','model','year','customer_name','work_order',
            ])
            ->when(  $hide_not_arrived, function( $query ){
                $query->whereHas('dates', function( Builder $query){
                    $query->where('name', '=' ,'arrival')
                        ->where('current', '=', true);
                });
            })
            ->when( $hide_departed, function( $query ){
                    $query->whereDoesntHave('dates', function( Builder $query){
                        $query->where('name', '=' ,'compound_exit')
                            ->where('current', '=', true);
                    });
            })
//            ->whereRaw("UPPER(make) = 'FORD'")
            ->with('dates')
            ->where('created_at','>','2021-05-31')
            ->where('vin','!=','')
            ->orderBy('created_at', 'DESC')
            ->get();

        $milestones = VehicleDate::ford_milestone();


        $results = [];

        foreach( $vehicles as $vehicle )
        {
            $result = [
                'id' => $vehicle->id,
                'identifier' => $vehicle->identifier,
                'vin' => $vehicle->vin,
                'customer_name' => $vehicle->customer_name,
                'make' => $vehicle->make,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'milestones' => $vehicle->milestones()
            ];

            foreach( $milestones as $milestone )
            {
                $result[$milestone] = $vehicle
                                        ->milestones()
                                        ->has($milestone);
            }



            $results[] = $result;
        }

        $results = json_decode( json_encode($results ) );

        return response()
            ->view('vehicles::reports.ford_date_compliance_report', [
            'results' => $results,
            'milestones'=> $milestones
        ]);
      //  dd( json_decode( json_encode($results ) ) );
    }
}