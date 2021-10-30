<?php

namespace Modules\Vehicles\Http\Controllers\Warranty;

use App\Http\Controllers\Controller;
use App\Models\WarrantyClaim;
use App\Models\Vehicle;
use App\Rules\ValidVinRule;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class CreateController extends Controller
{
    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function create( Vehicle $vehicle ): View
    {

        return view('vehicles::warranty.create',
            [
                'vehicle' => $vehicle,
            ]);
    }


    /**
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function store( Request $request, Vehicle $vehicle ): RedirectResponse
    {
        $request->validate([
            'first_name' => "required|string|max:50",
            'last_name' => "required|string|max:50",
            'email' => "required|string|max:50",
            'phone' => "required|string|max:20",
            'organization' => "required|string|max:50",
            'make' => "required|string|max:25",
            'model' => "required|string|max:25",
            'year' => "required|int",
            'mileage' => "nullable|int",
            'vin' =>                 ['bail',
                'alpha_num',
                'min:17',
                'max:17',
                new ValidVinRule,

            ],
            'date' => "required|string|max:25",
            'issue' => "required|string|max:2000",
            'vehicle_id' => 'required|int',
            'notes' => 'nullable|string'
        ]);


        $claim = new WarrantyClaim( $request->only(
            [ 'vehicle_id','first_name', 'last_name', 'email',
                'phone',  'organization',  'make',  'model', 'year',
                'mileage', 'vin',  'date',  'issue','notes']));
        $claim->pin = $this->pin();



        $claim->save();

        return redirect()
            ->route('vehicle.home', [$vehicle]);
    }






    /**
     * generates a random 10 character pin
     *
     * @return string
     */
    private function pin(): string
    {
        $text = "";
        $possible = "ACDEFGHJKLMNPRTUVWXY34679";

        for ($i = 0; $i < 10; $i++)
        {
            $text .= substr( $possible, rand(0, strlen($possible)), 1);
        }

        return $text;
    }


}
