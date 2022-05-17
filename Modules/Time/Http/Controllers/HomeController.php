<?php

namespace Modules\Time\Http\Controllers;


use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use Inertia\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class HomeController extends Controller
 {



    /**
     * @return Response
     */
    public function home(): Response
    {

            $prefixes = DB::connection('syspro')
                ->table('WipMaster')
                ->selectRaw("  LEFT(Job,3)  AS Prefix ")
                ->where('Complete', '=', 'N')
                ->orderBy('Prefix', 'ASC')
                ->distinct('Prefix')
                ->pluck('Prefix');


        return Inertia::render('Pages/Home', [
            'prefixes' => $prefixes,
            'user' => Auth::user(),
        ]);
    }


    public function logOut()
    {
        return redirect("/time/");
    }



    public function fetchAvailableJobs( string $prefix )
    {

     //   dd( $prefix );
     return DB::connection('syspro')
            ->table('WipMaster')
           ->select('Job', 'JobDescription')
            ->where( 'Complete' , '=', 'N' )
           ->where(  'Job', 'like', "{$prefix}%" )
            ->orderBy('Job', 'ASC')
            ->get()
            ->toJson();
    }



//    public function clockIn( Request $request )
//    {
//        dd( $request );
//    }
 }
