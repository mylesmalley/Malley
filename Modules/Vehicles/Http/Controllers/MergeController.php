<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\RedirectResponse as RedirectResponseAlias;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

/**
 * A controller to facilitate merging two vehicles by showing side by side
 * details about them and giving the user the ability to move data around
 *
 *
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class MergeController extends Controller
{
    /**
     * returns a nice view showing columns of data about two vans
     * and options to move things back and forth between them.
     *
     * @param Vehicle $a
     * @param Vehicle $b
     * @return View
     */
    public function compare( Vehicle $a, Vehicle $b ): view
    {
        return view('vehicles::merge.compare',[
            'a' => $a,
            'b' => $b,
        ]);
    }


    /**
     * moves all files uploaded to a vehicle to another vehilcle
     *
     * @param Vehicle $a
     * @param Vehicle $b
     * @return RedirectResponseAlias
     */
    public function moveFiles( Vehicle $a, Vehicle $b ): RedirectResponseAlias
    {
        if ( $a->media )
        {
            foreach( $a->media as $media )
            {
                $media->move( $b, 'uploads', 's3' );
            }
        }

        return redirect()
            ->back();
    }


    /**
     * moves any albums associated to A to B
     *
     * @param Vehicle $a
     * @param Vehicle $b
     * @return RedirectResponseAlias
     */
    public function moveAlbums( Vehicle $a, Vehicle $b ): RedirectResponseAlias
    {
        DB::table('vehicle_albums')
            ->where('vehicle_id','=', $a->id  )

        ->update(['vehicle_id'=> $b->id ]);

        return redirect()
            ->back();
    }



    /**
     * moves any dates associated to A to B
     *
     * @param Vehicle $a
     * @param Vehicle $b
     * @return RedirectResponseAlias
     */
    public function moveDates( Vehicle $a, Vehicle $b ): RedirectResponseAlias
    {
        DB::table('vehicle_dates')
            ->where('vehicle_id','=', $a->id  )

            ->update(['vehicle_id'=> $b->id ]);

        return redirect()
            ->back();
    }


    /**
     * moves any dates associated to A to B
     *
     * @param Vehicle $a
     * @param Vehicle $b
     * @param string $field
     * @return RedirectResponseAlias
     */
    public function moveField( Vehicle $a, Vehicle $b, string $field ): RedirectResponseAlias
    {
        $b->$field = $a->$field;
        $b->save();

        return redirect()
            ->back();
    }


    /**
     * @param Vehicle $vehicle
     * @return RedirectResponseAlias
     */
    public function markForDeletion( Vehicle $vehicle ): RedirectResponseAlias
    {
        $vehicle->malley_number = "DELETEME";
        $vehicle->save();

        return redirect()
            ->back();
    }



}
