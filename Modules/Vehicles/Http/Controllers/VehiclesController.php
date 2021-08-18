<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\WarrantyClaim;
//use App\Models\Inspection;
use Spatie\ValidationRules\Rules\Delimited;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Rules\MalleyIDRule;
use App\Rules\ValidVinRule;
use Ixudra\Curl\Facades\Curl;
use Illuminate\Support\Facades\Auth;


class VehiclesController extends Controller
{

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        return view('vehicles::create');
    }

    /**
     * creates a new vehicle object, queries nhtsa database for details
     * then redirects to the edit form.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request ): RedirectResponse
    {
        $request->validate([
            'vin' => [
                'bail',
                'sometimes',
                Rule::requiredIf(!$request->customer_name
                    && !$request->malley_number && !$request->work_order),

             //   'required_without:customer_name,malley_number',
                'alpha_num',
                'min:17',
                'max:17',
                new ValidVinRule,
                'unique:vehicles,vin',
                'nullable' ,
            ],
            'malley_number' => [
                'bail',

                'sometimes',
              //  'required_without:vin,customer_name',
                Rule::requiredIf(!$request->customer_name
                    && !$request->vin && !$request->work_order),

                'alpha_num',
                new MalleyIDRule,
                'unique:vehicles,malley_number',
                'nullable',
            ],
            'customer_name' => [
                'bail',

                'sometimes',

                "nullable",
                Rule::requiredIf(!$request->malley_number
                    && !$request->vin && !$request->work_order),

         //       "required_without:vin,malley_number",
                "string",
                "max:100",
            ],

            'work_order' => [
        'bail',

        'sometimes',
        "nullable",
        Rule::requiredIf(!$request->malley_number
            && !$request->vin && !$request->customer_name),
                "string",
        "max:20",
    ]
            ],

        );

        $vehicle = new Vehicle;

        $vehicle->vin = $request->vin ?? "";
        $vehicle->customer_name = $request->customer_name ?? "";

        $vehicle->user_id = Auth::user()->id ?? 129;
     //   $vehicle->location = $request->location;

        if ($request->vin )
        {
            // NhTSA API call
            $curl = Curl::to("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/".$vehicle->vin)
                ->withData(['format'=>'json'])
                ->get();
            /** @noinspection PhpComposerExtensionStubsInspection */
            $nhtsa = json_decode($curl);

          //  dd( $nhtsa );
            //  dd($nhtsa->Results[0]->Make);
          $results = $nhtsa->Results[0];

            // $edmunds = Edmunds::decodeVin( $request->vin );
            $vehicle->make = substr($results->Make,0,20) ?? null;
            $vehicle->model =  substr($results->Model,0,20) ?? null;
            $vehicle->fuel = substr( $results->FuelTypePrimary,0,20) ?? null;
            $vehicle->drive =  substr($results->DriveType ,0,20)?? null;
            $vehicle->year = substr($results->ModelYear,0,4) ?? date('Y');
            // $vehicle->manufacturer_code = $edmunds['manufacturerCode'] ?? null;
            $vehicle->interior_colour = "Grey";
            $vehicle->exterior_colour = "White";
         //   $vehicle->raw_nhtsa_data = json_encode($nhtsa);
        }


        $vehicle->malley_number = $request->malley_number ?? "";
        $vehicle->work_order = $request->work_order ?? "";

        $vehicle->save();
        //    $vehicle->upgrade();

        return redirect('/vehicles/'.$vehicle->id.'/edit');
    }


    /**
     * @param Vehicle $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function show( Vehicle $vehicle )
    {

        // if the warranty claim table has matches to this vin, include them
        $claims = ( $vehicle->vin )
            ? WarrantyClaim::where('vin', $vehicle->vin )->get()
            : collect([]);


        return view('vehicles::show',[
            'vehicle' => $vehicle,
            'claims' => $claims,
//            'inspections' => $inspections,
        ]);
    }


    /**
     * @param Vehicle $vehicle
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit( Vehicle $vehicle )
    {
        return view('vehicles::edit',[
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * validates and stores changes to a vehicle. redirects back to it's query page
     *
     * @param Request $request
     * @param Vehicle $vehicle
     * @return RedirectResponse
     */
    public function update( Request $request, Vehicle $vehicle): RedirectResponse
    {
        $validated_columns = [
            'vin' => [

                'sometimes',
                Rule::requiredIf(!$request->customer_name && !$request->malley_number),
                //   'required_without:customer_name,malley_number',
                'alpha_num',
                'min:17',
                'max:17',
                Rule::unique('vehicles')->ignore($vehicle),
                new ValidVinRule,
                'nullable' ,
            ],
            'malley_number' => [
                'sometimes',
                //  'required_without:vin,customer_name',
                Rule::requiredIf(!$request->customer_name && !$request->vin),

                'alpha_num',
                new MalleyIDRule,
                Rule::unique('vehicles')->ignore($vehicle),
                'nullable',

            ],
            'customer_name' => [
                'sometimes',

                "nullable",
                Rule::requiredIf(!$request->malley_number && !$request->vin),

                //       "required_without:vin,malley_number",
                "string",
                "max:100",
            ],
            'customer_number'=>'nullable|string|max:20',
            'company_id' => 'required|int',
            'user_id' => 'sometimes|int',
            'blueprint_id' => 'nullable|int',
            'refurb_number' => 'nullable|string|max:20',
            'make' => 'nullable|string|max:20',
            'model' => 'nullable|string|max:40',
            'year' => 'nullable|numeric',
            'wheelbase' => 'nullable|string|max:40',
            'roof_height' => 'nullable|string|max:40',
            'exterior_colour' => 'nullable|string|max:20',
            'interior_colour' => 'nullable|string|max:20',
            'fuel' => 'nullable|string|max:200',
            'engine' => 'nullable|string|max:200',
            'manufacturer_code' => 'nullable|string|max:20',
            'drive' => 'nullable|string|max:100',
            'notes' => 'nullable|string',
            'work_order'=> ['nullable', new Delimited('alpha_num') ],
            'country' => 'nullable|string',
            'oem_dealer' => 'nullable|string|max:255,'
        //    'customer_name' => "nullable|string|max:100",
        ];


        $request->validate( $validated_columns );

        $vehicle->update( $request->only( array_keys( $validated_columns ) ));

        return redirect('/vehicles/'.$vehicle->id);
    }



    public function all()
    {
        return view('vehicles::all', [
            'vehicles' => Vehicle::orderBy('work_order','ASC')->paginate(2000),
        ]);
    }


    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function editRegulatory( Vehicle $vehicle ): View
    {
        return view('vehicles::info.regulatory',[
            'vehicle'=>$vehicle
        ]);
    }

    public function updateRegulatory( Request $request, Vehicle $vehicle )
    {
        $vehicle->update( $request->all() );
        //        dd($request->all() );

        return redirect()->back();
     //   dd('submitted');
    }








}
