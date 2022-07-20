<?php

namespace Modules\Vehicles\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class RefurbReport extends Controller
{
    /**
     * @return Response
     */
    public function view( ): Response
    {
        $matches = DB::table('refurb_ambulance_report')
            ->orderBy('returned_for_refurb','ASC')
            ->get();

        return response()
            ->view('vehicles::reports.refurb_report', [
            'matches' => $matches,
        ]);
    }

}