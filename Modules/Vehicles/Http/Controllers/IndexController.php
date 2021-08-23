<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\View\View;



class IndexController extends Controller
{
    /**
     * Returns a nice list of paginated vehicles
     *
     * @return View
     */
    public function index(): View
    {
        $vehicles = Vehicle::with('dealer')
            ->orderBy('malley_number','DESC')
            ->paginate(20);

        return view('vehicles::index', [
            'title' => "All Vehicles",
            'vehicles' => $vehicles
        ]);
    }


    /**
     * @param string $prefix
     * @param string|null $prefix2
     * @param string|null $title
     * @return View
     */
    public function category( string $prefix, string $prefix2 = null, string $reportTitle = null ): View
    {

        // double check that only letters are numbers are submitted - no symbols
        if (!ctype_alnum($prefix)) die('only letters and numbers are accepted');
        if ( $prefix2 )
        {
            if (!ctype_alnum($prefix2)) die('only letters and numbers are accepted');
        }

        $title = $reportTitle ??  "All {$prefix} Vehicles";
        $title = urldecode($title);


        $vehicles = Vehicle::with('dealer')
            ->where('first_work_order', 'like', "{$prefix}%")
            ->when( $prefix2, function ($query) use ($prefix2){
                $query->orWhere('first_work_order', 'like', "{$prefix2}%");
            })
        ->orderBy('computed_vehicle_number','DESC')
            ->paginate(20);

        return view('vehicles::index', [
            'title' => $title,
            'vehicles' => $vehicles
        ]);
    }


}
