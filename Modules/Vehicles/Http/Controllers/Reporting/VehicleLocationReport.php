<?php

namespace Modules\Vehicles\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Response;

class VehicleLocationReport extends Controller
{
    /**
     * @return Response
     */
    public function view( ): Response
    {
        $matches = Vehicle::whereIn('location', ['At Malley', 'Off site; coming back'])
            ->select(['id','vin','make','model','year','location','work_order'])
            ->with(['dates' => function($query){
                $query
                    ->where('location','!=', null)
                    ->where('timestamp', '<=', Carbon::today());
            },'dates.user'])
            ->get();

       // dd( $matches );

    //    dd( $matches->first() );

        return response()
            ->view('vehicles::reports.vehicle_location_report', [
            'matches' => $matches,
        ]);
    }

}