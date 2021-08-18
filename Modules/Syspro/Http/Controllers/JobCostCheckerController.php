<?php

namespace Modules\Syspro\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;

class JobCostCheckerController extends Controller
{

    /**
     * @param Request $request
     * @param string|null $jobCode
     * @return View
     */
    public function show( Request $request, string $jobCode = null ): View
    {
        $code = $jobCode ?? $request->jobCode ?? null;

       // if ( is_null( $code )) die( "No valid job supplied" );

        $parent = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_JOB_COST_CHECKER_PARENT( ? )" ) )
            ->select('*')
            ->setBindings([ $code ])
            ->first();


       // if ( !$parent ) die( "Problem Finding Job" );


        $children = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_JOB_COST_CHECKER_CHILDREN( ? )" ) )
            ->select('*')
            ->setBindings([ $code ])
            ->get();


      //  if( $code) dd( $children );


        return view('syspro::JobCostChecker', [
            'parent' => $parent,
            'children' => $children,
        ]);
    }

}
