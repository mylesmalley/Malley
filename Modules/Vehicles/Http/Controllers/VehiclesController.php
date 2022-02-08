<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\WarrantyClaim;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Support\Facades\Log;
use Spatie\ValidationRules\Rules\Delimited;
use Illuminate\Validation\Rule;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Rules\MalleyIDRule;
use App\Rules\ValidVinRule;
use Illuminate\Support\Facades\Auth;


class VehiclesController extends Controller
{

    /**
     * @return Response
     */
    public function create(): Response
    {
        return response()
            ->view('vehicles::create');
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
                Rule::requiredIf(!$request->input('customer_name')
                    && !$request->input('malley_number') && !$request->input('work_order')),
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
                Rule::requiredIf(!$request->input('customer_name')
                    && !$request->input('vin') && !$request->input('work_order')),

                'alpha_num',
                new MalleyIDRule,
                'unique:vehicles,malley_number',
                'nullable',
            ],
            'customer_name' => [
                'bail',

                'sometimes',

                "nullable",
                Rule::requiredIf(!$request->input('malley_number')
                    && !$request->input('vin') && !$request->input('work_order')),
                "string",
                "max:100",
            ],

            'work_order' => [
        'bail',

        'sometimes',
        "nullable",
        Rule::requiredIf(!$request->input('malley_number')
            && !$request->input('vin') && !$request->input('customer_name')),
                "string",
        "max:20",
    ]
            ],

        );

        $vehicle = new Vehicle;

        $vehicle->vin = $request->input('vin') ?? "";
        $vehicle->customer_name = $request->input('customer_name') ?? "";

        $vehicle->user_id = Auth::user()->id ?? 129;

        if ($request->input('vin') )
        {

            $client = new Client([
                'base_uri' => "https://vpic.nhtsa.dot.gov/api/"
            ]);

            $response = null;

            try {
                $response = $client->request('GET', "vehicles/DecodeVinValuesExtended/".$vehicle->vin,
                [ 'query' => ['format' => 'json']]);
            } catch (GuzzleException)
            {
                Log::error("Guzzle error pinging NHTSA");
            }


            $nhtsa =  json_decode( $response->getBody()->getContents() );

            $results = $nhtsa->Results[0];

            $vehicle->make = substr($results->Make,0,20) ?? null;
            $vehicle->model =  substr($results->Model,0,20) ?? null;
            $vehicle->fuel = substr( $results->FuelTypePrimary,0,20) ?? null;
            $vehicle->drive =  substr($results->DriveType ,0,20)?? null;
            $vehicle->year = substr($results->ModelYear,0,4) ?? date('Y');
            $vehicle->interior_colour = "Grey";
            $vehicle->exterior_colour = "White";

        }


        $vehicle->malley_number = $request->input('malley_number') ?? "";
        $vehicle->work_order = $request->input('work_order') ?? "";

        $vehicle->save();

        Log::info("Created vehicle $vehicle->id");

        return redirect('/vehicles/'.$vehicle->id.'/edit');
//        return redirect()
//            ->route('vehicle.ed', [$vehicle]);
    }


    /**
     * @param Vehicle $vehicle
     * @return Response
     */
    public function show( Vehicle $vehicle ): Response
    {
        // if the warranty claim table has matches to this vin, include them
        $claims = ( $vehicle->vin )
            ? WarrantyClaim::where('vin', $vehicle->vin )->get()
            : collect([]);

        $vehicle->load('dates', 'serials');

        return response()
            ->view('vehicles::show',[
            'vehicle' => $vehicle,
            'claims' => $claims,
//            'inspections' => $inspections,
        ]);
    }


    /**
     * @param Vehicle $vehicle
     * @return Response
     */
    public function edit( Vehicle $vehicle ): Response
    {
        return response()
            ->view('vehicles::edit',[
            'vehicle' => $vehicle,
        ]);
    }

    /**
     * validates and stores changes to a vehicle. redirects back to its query page
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
                Rule::requiredIf(!$request->input('customer_name') && !$request->input('malley_number') ),
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
                Rule::requiredIf(!$request->input('customer_name') && !$request->input('vin') ),

                'alpha_num',
                new MalleyIDRule,
                Rule::unique('vehicles')->ignore($vehicle),
                'nullable',

            ],
            'customer_name' => [
                'sometimes',

                "nullable",
                Rule::requiredIf(!$request->input('malley_number') && !$request->input('vin') ),

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
        Log::info("Updated vehicle $vehicle->id");

        return redirect()
            ->route('vehicle.home', [$vehicle]);
    }


    /**
     * @return Response
     */
    public function all(): Response
    {
        return response()
            ->view('vehicles::all', [
            'vehicles' => Vehicle::orderBy('work_order','ASC')->paginate(2000),
        ]);
    }











}
