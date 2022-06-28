<?php

namespace Modules\BodyguardBOM\Http\Controllers\Parts;

use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Modules\BodyguardBOM\Models\Kit;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Modules\BodyguardBOM\Http\Controllers\PartNumberComponentsTrait;

class CreateController extends Controller
{

    use PartNumberComponentsTrait;

    /**
     * @return Response
     */
    public function create( ) : Response
    {
        return response()->view('bodyguardbom::parts.create', [
            'prefixes' => $this->prefix,
            'colours' => $this->colours,
            'roof_heights' => $this->roof_heights,
            'kit_codes' => $this->part_codes,
            'chassis' => $this->chassis,
            'part_locations' => $this->part_locations,
        ]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request ) : RedirectResponse
    {
        $request->validate([
            'part_number' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'category' => 'required',
            'colour' => 'required',
            'kit_code' => 'required',
            'location' => 'required',
            'chassis' => 'required',
            'roof_height' => 'required',
        ]);

        $kit = Kit::create( $request->only([
            'part_number',
            'description',
            'colour',
            'category',
            'kit_code',
            'roof_height',
            'location',
            'category',
            'chassis',
        ]));

        $kit->create_phantom_in_syspro();

        return redirect( )
            ->route('bg.parts.home', [
                'chassis' => $request->input('chassis'),
                'roof_height' => $request->input('roof_height'),
                'location' => $request->input('location'),
                'kit_code' => $request->input('kit_code'),
                'colour' => $request->input('colour'),
            ]);
    }


    /**
     * @param Kit $kit
     * @return Response
     */
    public function create_components_from_template( Kit $kit ): Response
    {

        $template = $this->kit_codes[ $kit->kit_code ] ?? null;

        if (!$template)
        {
            die("no template set for this");
        }

    //    dd( $template );


        return response()->view('bodyguardbom::parts.create_from_template', [
                'kit' => $kit,
                'template' => $template['template'],

                'colours' => $this->colours,
                'roof_heights' => $this->roof_heights,
                'kit_codes' => $this->part_codes,
                'chassis_list' => $this->chassis,
                'part_locations' => $this->part_locations,

                'chassis' => $kit->chassis,
                'roof_height' => $kit->roof_height,
                'location' => $kit->location,
                'kit_code' => $kit->kit_code,
                'colour' => $kit->colour,
            ]);
        //dd(      );
    }


    public function store_bulk_components( Request $request )
    {
        $number_of_rows = count($request->input('include.*'));

        $rules = [];

        for ($i = 0; $i < $number_of_rows; $i++)
        {
            $rules += [
                "include.$i" => "required|boolean",
                "colour.$i"  => "exclude_if:include.$i,==,false|string",
                "part_number.$i"  => "exclude_if:include.$i,==,false|string",
                "description.$i"  => "exclude_if:include.$i,==,false|string",
                "chassis.$i"  => "exclude_if:include.$i,==,false|string",
                "roof_height.$i"  => "exclude_if:include.$i,==,false|string",
                "location.$i"  => "exclude_if:include.$i,==,false|string",
                "kit_code.$i"  => "exclude_if:include.$i,==,false|string",

//                "part_number.$i" => [
//                    Rule::requiredIf( (bool)$request->input("include.$i") ) ,
//                 //   'required',
//                    'string',
//                ],
//                "description.$i" => [
//                    Rule::requiredIf( (bool)$request->input("include.$i") ) ,
//              //      'required',
//                    'string',
//                ],
//                "chassis.$i"  => [
//                    Rule::requiredIf( (bool)$request->input("include.$i") ) ,
//                //    'required',
//                    'string',
//                ],
//                "roof_height.$i"  => [
//                    Rule::requiredIf( (bool)$request->input("include.$i") ) ,
//                 //   'required',
//                    'string',
//                ],
//                "location.$i"  => [
//                    Rule::requiredIf( (bool)$request->input("include.$i") ) ,
//
//             //       'required',
//                    'string',
//                ],

//                "kit_code.$i"  => [
//                    Rule::requiredIf( (bool)$request->input("include.$i") ) ,
//            //        'required',
//                    'string',
//                ],
            ];
        }

      //  dd( $request->all() );

//        $request->validate([
//            'part_number.*' => 'required|string',
//            'description.*' => 'required|string',
//            'chassis.*' => 'required|string',
//            'roof_height.*' => 'required|string',
//            'location.*' => 'required|string',
//            'colour.*' => 'required|string',
//            'include.*' => 'required|boolean',
//            'kit_code.*' => 'required|string',
//        ]);

        //dd( (bool)$request->input('include.1'), $request->input('colour.1'), $request->all(), $rules );

     //   $request->validate( $rules );
        $validator = Validator::make($request->all(),
            $rules
        );//->stopOnFirstFailure(true);

        $validator->validate();
    }


    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function check_if_part_exists( Request $request ): JsonResponse
    {
        $request->validate([
            'part_number' => 'required|string',
        ]);

        return response()->json( Kit::where('part_number', '=', $request->input('part_number'))
            ->count() > 0 );
    }



}


