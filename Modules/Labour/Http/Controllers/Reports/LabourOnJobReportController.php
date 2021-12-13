<?php

namespace Modules\Labour\Http\Controllers\Reports;

use App\Models\Labour;
use App\Http\Controllers\Controller;
use Carbon\CarbonPeriod;
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
             //   ->with('user','department')
                ->orderBy('start','DESC')
                ->get();

            $unique_users = $labour
                ->unique('user_id')
                ->pluck('user_id')
                ->toArray();


            $unique_departments = $labour
                ->unique('department_id')
                ->pluck('department_id')
                ->toArray();

            $unique_departments = array_fill_keys( $unique_departments, 0 );

            //dd( $unique_departments );

            $first = $labour->first()->start;
            $last = $labour->last()->start;

            $range_els = CarbonPeriod::create( min( $first, $last), '1 day', max($first, $last ) );
            $range = [];


            foreach( $range_els as $date)
            {
                $range[] = $date->format('Y-m-d');
            }

            $by_date_by_dept = array_fill_keys( $range , $unique_departments);

         //   dd( $x );


            foreach( $labour as $l )
            {
                $date = $l->start->format('Y-m-d');
                $by_date_by_dept[$date][$l->department_id] += (int) $l->elapsed->totalSeconds;
            }





           // dd( $x );
            //dd( $unique_users,$unique_departments , $range );


        }

        return response()
            ->view('labour::reports.labour_on_job_report', [
                'job' => $job,
                'by_date_by_dept' => $by_date_by_dept,
                'labour' => $labour,
            ] );

    }




}
