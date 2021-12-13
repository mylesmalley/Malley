<?php

namespace Modules\Labour\Http\Controllers\Reports;

use App\Models\Labour;
use App\Http\Controllers\Controller;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Response;

class LabourOnJobReportController extends Controller
{

    /**
     * @param string|null $job
     * @return Response
     */
    public function show( string $job = null ): Response
    {
//        $this->authorize('labour_edit', Labour::class);

        $labour = null;

        if ( $job )
        {
            $labour = Labour::where('job', '=', $job )
                ->with('user','department')
                ->get();
        }

        return response()
            ->view('labour::reports.labour_on_job_report', [
                'job' => $job,
                'labour' => $labour,
            ] );

    }




}
