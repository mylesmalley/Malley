<?php

namespace Modules\Vehicles\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\VehicleDate;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;
use GuzzleHttp\Client;
use Modules\Vehicles\Jobs\FordMilestoneUpdate;

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
     * @return RedirectResponse
     */
    public function submit( VehicleDate $vehicleDate ): RedirectResponse
    {
        FordMilestoneUpdate::dispatch( $vehicleDate );

        return redirect()
            ->back();
    }
}