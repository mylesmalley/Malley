<?php

namespace Modules\Syspro\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;

class JobTrialKitController extends Controller
{

    /**
     * @param Request $request
     * @param string|null $jobCode
     */
    public function show( Request $request, string $jobCode = null )
    {
        $code = $jobCode ?? $request->jobCode ?? null;

        $children = DB::connection('syspro')
            ->select(DB::raw( "EXEC dbo.spJobTrialKit @Job = ? "), [ $code ]);

        // create an array of all stock codes listed
        $stockCodes = [];
        foreach( $children as $child )
        {
            $stockCodes[] =  $child->StockCode;
        }

        // create an array of duplicate stock codes
        $dups = array();
        foreach(array_count_values($stockCodes) as $val => $c)
        {
            if($c > 1) $dups[] = trim( $val );
        }


        return view('syspro::jobTrialKit', [
            'parent' => $code,
            'children' => $children,
            'duplicates' => $dups,
        ]);
    }

}
