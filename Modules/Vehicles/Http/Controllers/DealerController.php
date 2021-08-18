<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
//use App\Models\Vehicle;
use \Illuminate\View\View;
use App\Models\Company;
use Illuminate\Http\Request;

/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class DealerController extends Controller
{
//    /**
//     * @param Vehicle $vehicle
//     * @return View
//     */
//    public function show(Vehicle $vehicle): View
//    {
//        $bom = $this->get( $vehicle->work_order );
//
//
//        return view('vehicles::bom.show', [
//                'vehicle' => $vehicle,
//                'bom' => $bom,
//            ]);
//    }
//

    /**
     * @return View
     */
    public function index(  ): View
    {
        return view('vehicles::dealers.index',[
            'dealers' => Company::orderBy('name','ASC')
                ->get()
        ]);
    }

    /**
     * @return View
     */
    public function create(  ): View
    {
        return view('vehicles::dealers.create');
    }

    /**
     * @param Request $request
     */
    public function store( Request $request )
    {
        $request->validate([
            'name' => 'required|unique:companies,name',
        ]);

        Company::create($request->only('name'));

        return redirect('/vehicles/dealers');

    }


}
