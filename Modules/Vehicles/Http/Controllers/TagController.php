<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Tag;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class TagController extends Controller
{


    /**
     * @param Tag $tag
     * @return View
     */
    public function show( Tag $tag ): View
    {
        return view('vehicles::tags.show', [
            'results' => $tag->vehicles, //->orderBy('malley_number'),
            'tag' => $tag,
        ]);
    }


    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function vehicleTags( Vehicle $vehicle ) : View
    {
        $vehicleTags = DB::table('vehicle_tags')
            ->where('vehicle_id', $vehicle->id )
            ->pluck('id','tag_id')
            ->toArray();

        return view('vehicles::tags.assign', [
            'vehicle' => $vehicle,
            'availableTags' => Tag::orderBy('name')->where('base_van_id',null)->get(),
            'vehicleTags' => $vehicleTags,
        ]);
    }

    /**
     * @param Vehicle $vehicle
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function delete( Vehicle $vehicle, Tag $tag  ): RedirectResponse
    {
        DB::table('vehicle_tags')->where([
            'tag_id'=> $tag->id,
            'vehicle_id'=>$vehicle->id
        ])->delete();
        return redirect()->back();
    }

    /**
     * @param Vehicle $vehicle
     * @param Tag $tag
     * @return RedirectResponse
     */
    public function create( Vehicle $vehicle, Tag $tag ): RedirectResponse
    {
        DB::table('vehicle_tags')->insert([
            'vehicle_id'=>$vehicle->id,
            'tag_id'=> $tag->id
        ]);
        return redirect()->back();
    }



}
