<?php

namespace Modules\Vehicles\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use App\Models\WarrantyClaim;
use App\Models\Vehicle;
use \Illuminate\View\View;
use \Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class ClaimController extends Controller
{
    /**
     * @param Vehicle $vehicle
     * @param WarrantyClaim $claim
     * @return View
     */
    public function show( Vehicle $vehicle, WarrantyClaim $claim ): View
    {

        return view('vehicles::warranty.show',
            [
                'vehicle' => $vehicle,
                'claim' => $claim,
            ]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @param WarrantyClaim $claim
     * @return RedirectResponse
     */
    public function update( Request $request, Vehicle $vehicle, WarrantyClaim $claim ): RedirectResponse
    {
        $request->validate(['notes' => 'string']);

        $claim->update($request->only(['notes']));
        $claim->save();
        return redirect("/vehicles/{$vehicle->id}");
    }


    public function index()
    {
        $claims = WarrantyClaim::orderBy('id', 'DESC')
            ->paginate(25);

        return view('vehicles::warranty.index', ['claims' => $claims]);
    }

}
