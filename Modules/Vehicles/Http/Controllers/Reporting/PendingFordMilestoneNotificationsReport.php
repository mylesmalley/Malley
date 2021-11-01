<?php

namespace Modules\Vehicles\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\VehicleDate;
use Illuminate\View\View;


class PendingFordMilestoneNotificationsReport extends Controller
{
    /**
     * @return View
     */
    public function view(  ): View
    {
        $pending = VehicleDate::where('update_ford', '=', true)
            ->where('submitted_to_ford', '=', false)
            ->where('current', '=', true)
            ->with('vehicle')
            ->get();

        return view('vehicles::reports.pending_ford_milestones_report', [
            'pending' => $pending,
        ]);
    }

    /**
     * @param VehicleDate $vehicleDate
     */
    public function submit( VehicleDate $vehicleDate )
    {


        $data = [
            "vin" => $vehicleDate->vehicle->vin,
            "code" => VehicleDate::ford_milestone_code($vehicleDate->name),
            "statusUpdateTs" => $vehicleDate->timestamp,
            "references" => [
                [
                    "qualifier" => "senderName",
                    "value" => "Malley Industries Inc."
                ],
                [
                    "qualifier" => "receiverCode",
                    "value" => "FORDIT",
                ],
                [
                    "qualifier" => "scac",
                    "value" => "MALLEY",
                ],
                [
                    "qualifier" => "ms1LocationCode",
                    "value" => "DIEPPE",
                ],
                [
                    "qualifier" => "ms1StateOrProvinceCode",
                    "value" => "NB",
                ],
                [
                    "qualifier" => "ms1CountryCode",
                    "value" => "Canada",
                ],
                [
                    "qualifier" => "compoundCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "yardCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "bayCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "partnerType",
                    "value" => "UP",
                ]
            ]

        ];



        dd( json_encode( $data) );

    }
}