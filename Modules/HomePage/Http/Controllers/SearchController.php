<?php

namespace Modules\HomePage\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Album;
use App\Models\Blueprint;



class SearchController extends Controller
{

    /**
     * @param Request $request
     * @return string
     */
    private function blueprint2( Request $request )
    {
        $results = Blueprint::search( $request->search_term )
            ->take(10)
            ->raw();

        return collect( $results )->toJson();

    }

    /**
     * @param Request $request
     * @return string
     */
    private function vehicle2( Request $request )
    {
        $results = Vehicle::search( $request->search_term )
            ->take(10)
            ->raw();

        return collect( $results )->toJson();

    }






    private function blueprint( Request $request )
    {

        $results = [
            'columns' => [
                'id' => 'ID',
                'name' => 'Name',
                "user_name" => 'Created By',
            ],
            'url' => "https://blueprint.malleyindustries.com/blueprint/",
            'rows' => []
        ];

        $results['rows'] = DB::table('blueprints')
            ->selectRaw( "
                blueprints.id,
                CONCAT( users.first_name, ' ' , users.last_name) AS user_name,
                blueprints.name
            " )
            //    ->where('name', 'like', '%'.$request->search_term.'%')
            ->whereRaw('name collate SQL_Latin1_General_CP1_CI_AS like ?', ['%'.$request->search_term.'%'] )
            ->leftJoin('users', 'blueprints.user_id','=','users.id' )
            ->orderBy('blueprints.id','DESC')
            ->limit(10)
            ->get();

        return collect( $results )->toJson();

    }




    /**
     * @param Request $request
     * @return string
     */
    private function vehicles_by_vin( Request $request )
    {
        $results = [
            'columns' => [
                'vin' => 'VIN',
                'year' => 'Year',
                'work_order' => 'Work Order(s)',
            ],
            'url' => "/vehicles",
            'rows' => []
        ];


        $results['rows'] = DB::table('vehicles')
            ->selectRaw( "id,
                vin,
                CONCAT( make , ' ', model ) as type,
                year
                ")
           // ->where('vin', 'like', '%'.$request->search_term.'%')
            ->whereRaw('vin collate SQL_Latin1_General_CP1_CI_AS like ?', ['%'.$request->search_term.'%'] )

            //            ->orderBy('blueprints.id','DESC')
            ->limit(10)
            ->get();

        return collect( $results )->toJson();

    }



    /**
     * @param Request $request
     * @return string
     */
    private function vehicles_by_work_order( Request $request )
    {
        $results = [
            'columns' => [
                'work_order' => 'Work Order(s)',
                'vin' => 'VIN',
                'type' => 'Description',
                'year' => 'Year',
            ],
            'url' => "/vehicles",
            'rows' => []
        ];


        $results['rows'] = DB::table('vehicles')
            ->selectRaw( "id,
                vin,
                CONCAT( make , ' ', model ) as type,
                year,
                work_order
                ")
            //->where('work_order', 'like', '%'.$request->search_term.'%')
            ->whereRaw('work_order collate SQL_Latin1_General_CP1_CI_AS like ?', ['%'.$request->search_term.'%'] )
//            ->orderBy('blueprints.id','DESC')
            ->limit(10)
            ->get();

        return collect( $results )->toJson();

    }





    /**
     * @param Request $request
     * @return string
     */
    private function albums( Request $request )
    {
        $results = [
            'columns' => [
//                'id' => 'ID',
                'search_string' => 'Album',
            ],
            'url' => "/vehicles",
            'rows' => []
        ];




        $albums = Album::whereRaw('search_string collate SQL_Latin1_General_CP1_CI_AS like ?', ['%'.$request->search_term.'%'] )
            ->with('media')
            ->whereHAs('media')
//            ->orderBy('blueprints.id','DESC')

            ->take(5)
            ->get();

        $formatted = [];

        foreach( $albums as $album )
        {
            $tmp = [
                'id' => $album->id,
                'name' => $album->name,
                'search_string' => $album->search_string,
            ];

            $media = [];
            foreach( $album->media->slice(0,6) as $m )
            {
                $media[] = $m->cdnUrl('thumb');
            }
            $tmp['media'] = $media;


            $formatted[] = $tmp;
        }




        $results['rows'] = $formatted;


        return collect( $results )->toJson();

    }






    /**
     * @param Request $request
     * @return string
     */
    public function search( Request $request )
    {
        $request->validate([
            'search_term' => 'required|string|min:3',
            'search_location' => 'required|string',
        ]);

        switch ($request->input('search_location'))
        {
            case 'blueprint':
                return $this->blueprint( $request );


            case 'blueprint2':
                return $this->blueprint2( $request );

            case 'vehicles2':
                return $this->vehicle2( $request );


            case 'vehicles_by_vin':
                return $this->vehicles_by_vin( $request );
            case 'vehicles_by_work_order':
                return $this->vehicles_by_work_order( $request );
            case 'albums':
                return $this->albums( $request );

            default:
                return $this->blueprint( $request );
        }
    }
}
