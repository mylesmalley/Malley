<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Inspection;
use Exception;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class AlbumController extends Controller
{


    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function show( Vehicle $vehicle ): View
    {
        return view('vehicles::albums.link', [ 'vehicle'=>$vehicle]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store( Request $request, Vehicle $vehicle )
    {
        $request->validate([
            'vehicle_id' => "required|integer",
            'album_url' => "required|url",
        ]);

        $id =  explode('/', $request->album_url );
        $id = end( $id );


        DB::table('vehicle_albums')->insert([
            'vehicle_id' => $request->vehicle_id,
            'album_id' => (int) $id,
        ]);

        return redirect()->back();
    }



    public function delete( Vehicle $vehicle, int $album_id )
    {
        DB::table('vehicle_albums')
            ->where('vehicle_id' ,'=', $vehicle->id  )
            ->where('album_id', '=', $album_id )
            ->delete();

        return redirect()->back();
    }





}
