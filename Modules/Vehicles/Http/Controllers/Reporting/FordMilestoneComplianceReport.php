<?php

namespace Modules\Vehicles\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;


class FordMilestoneComplianceReport extends Controller
{
    public function view()
    {
        $vehicles = Vehicle::select([
                'id','vin','work_order','malley_number','customer_number',
                'make','model','year','customer_name'
            ])
            ->whereRaw("UPPER(make) = 'FORD'")
            ->with('dates')
            ->where('created_at','>','2021-08-01')
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

        return view('vehicles::reports.ford_date_compliance_report', ['results' => $results, 'milestones'=> $milestones ]);
      //  dd( json_decode( json_encode($results ) ) );
    }
}