<?php

namespace Modules\Labour\Http\Controllers\Reports;

use App\Models\Department;
use App\Models\Labour;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

class LabourOnJobReportController extends Controller
{

    /**
     * @param string|null $job
     * @return Response
     */
    public function show( string $job = null ): Response
    {

        // grab all the labour on the job
        $labour = Labour::where('job', $job )
            ->with('user', 'department')
            ->get();

        // unique user ids based on the labour query
        $unique_users = User::select(['id','first_name','last_name','department_id'])
            ->whereIn('id', $labour->pluck('user_id')->unique())
            ->get()
            ->keyBy('id')
            ->toArray();

        // add in an empty element to handle accumulated labour
        $unique_users = array_map( function( $el ){
            $el['elapsed_labour'] = 0;
            return $el;
        }, $unique_users);

        // grab the departments used
        $unique_departments = Department::select(['id','name'])
            ->whereIn('id', $labour->pluck('department_id')
                ->unique()
            )
            ->get()
            ->keyBy('id')
            ->toArray();

        // add an empty labour field to catch accumulated time
        $unique_departments = array_map( function( $el ){
            $el['elapsed_labour'] = 0;
            return $el;
        }, $unique_departments);




        $used_dates = [];




        $total_labour = 0;

        // loop through the labour and add it on as needed.
        foreach( $labour as $l )
        {
            $elapsed_time = (int)$l->elapsed->totalSeconds;

            $date = $l->start->format('Y-m-d');

            if ( !array_key_exists($date, $used_dates))
            {
                $used_dates[$date] = $elapsed_time;
            }
            else
            {
                $used_dates[$date] += $elapsed_time;
            }


            $total_labour += $elapsed_time;
            $unique_departments[ $l['department_id'] ]['elapsed_labour'] += $elapsed_time;
            $unique_users[ $l['user_id'] ]['elapsed_labour'] += $elapsed_time;
        }


        //dd( $used_dates );


        return response()->view('labour::reports.labour_on_job_report', [
            'job' => $job,
            'labour' => $labour,
            'unique_departments' => $unique_departments,
            'unique_users' => $unique_users,
            'used_dates' => $used_dates,
            'total_labour' => $total_labour,
        ]);

    }
//
//    /**
//     * @param string|null $job
//     * @return Response
//     */
//    public function show( string $job = null ): Response
//    {
////        $this->authorize('labour_edit', Labour::class);
//
//
//            $labour = Labour::where('job', '=', $job )
//             //   ->with('user','department')
//                ->orderBy('start','DESC')
//                ->get();
//
//        $job = DB::connection('syspro')
//            ->table('WipMaster')
//            ->where('Job','=', $job )
//            ->first();
//
//            dd( $labour, $job );
////
////            if ( $labour->count() )
////            {
////
////                $unique_users = $labour
////                    ->unique('user_id')
////                    ->pluck('user_id')
////                    ->toArray();
////
////
////                $unique_departments = $labour
////                    ->unique('department_id')
////                    ->pluck('department_id')
////                    ->toArray();
////
////                $unique_departments = array_fill_keys( $unique_departments, 0 );
////                $unique_departments[] = 0;
////
////                $departments = Department::all()
////                    ->pluck('name', 'id')
////                    ->toArray();
////
////    //
////    //
////    //                dd( $unique_departments, $departments );
////
////                $first = $labour->first()->start;
////                $last = $labour->last()->start;
////
////                $range_els = CarbonPeriod::create( min( $first, $last), '1 day', max($first, $last ) );
////                $range = [];
////
////
////                foreach( $range_els as $date)
////                {
////                    $range[] = $date->format('Y-m-d');
////                }
////
////                $by_date_by_dept = array_fill_keys( $range , $unique_departments);
////
////             //   dd( $x );
////
////
////                foreach( $labour as $l )
////                {
////                    $date = $l->start->format('Y-m-d');
////                    $by_date_by_dept[$date][$l->department_id] += (int) $l->elapsed->totalSeconds;
////
////                    $by_date_by_dept[$date][count($unique_departments)] += (int) $l->elapsed->totalSeconds;
////                }
////
////
////
////            }
////
////
//////            dd( $departments );
////            //dd( $unique_users,$unique_departments , $range );
////
////            return response()
////                ->view('labour::reports.labour_on_job_report', [
////                    'job' => $job,
////                    'by_date_by_dept' => $by_date_by_dept ?? [],
////                    'departments' => $departments ?? [],
////                    'unique_departments' => $unique_departments ?? [],
////                    'labour' => $labour,
////                ] );
//        }





}
