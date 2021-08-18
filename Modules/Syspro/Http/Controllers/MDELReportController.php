<?php

namespace Modules\Syspro\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

/**
 * Class MDELReportController
 *
 * @package App\Http\Controllers\Syspro
 */
class MDELReportController extends Controller
{
    /**
     * Returns a page that shows work orders and associated MDELs
     *
     * @param Request $request
     * @return View
     */
    public function show( Request $request ): View
    {
        // validate teh query string parameters
        $request->validate([
            'year' => 'integer',
            'showComplete' => [
                'string',
                Rule::in('Y','N'),
            ],
            'sort' => [
                'string',
                Rule::in(['ASC', 'DESC']),
            ],
            'col' => [
                'string',
                Rule::in(['Job', 'JobDescription', 'status','JobTenderDate','JobClassification','MDEL'])
            ],
        ]);

        // set defaults if none provided
        $year = $request->query('year', 2019);
        $showComplete = $request->query('showComplete', "Y");
        $col = $request->query('col', "Job");
        $sort = $request->query('sort', 'ASC');


        $query = DB::connection('syspro')
            ->table('WipMaster')
            ->select([
                "WipMaster.Job",
                "WipMaster.JobDescription",
                "WipMaster.CustomerName",
                "WipMaster.Complete",
                "WipMaster.ConfirmedFlag AS status",
                "WipMaster.JobTenderDate",
                "WipMaster.JobClassification",
                "WJAM.StockDescription AS MDEL",
                "WJAM2.StockDescription AS VehicleType",
            ])
            // join in to get the type of job
            ->leftJoin("WipJobAllMat AS WJAM","WipMaster.Job", "=",DB::raw("WJAM.Job AND WJAM.StockCode = 'MDEL'") )
            // join in to get teh type of van from MDEL
            ->leftJoin("WipJobAllMat AS WJAM2","WipMaster.Job", "=",DB::raw("WJAM2.Job AND WJAM2.StockCode = 'VID'") )
            // only grab vehicle jobs
            ->whereIn('WipMaster.JobClassification', ['A','ABLS','MO','MRE','DS','LF',"FR"])
            // need to parse the date column for comparison
            ->where(DB::raw("year(WipMaster.JobTenderDate)"),'=',$year);


        // if complete and not required, don't query them
        if( $showComplete === "N" )
        {
            $query = $query->where("WipMaster.Complete", '!=', 'Y');
        }


        $query = $query->orderBy($col, $sort)
            ->get();

        return view('syspro::MDELreport.show', ['results' => $query ]);
    }
}
