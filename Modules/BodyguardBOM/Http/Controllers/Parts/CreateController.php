<?php

namespace Modules\BodyguardBOM\Http\Controllers\Parts;

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
     * @return Response|void
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
        dd( $request->all() );
    }



}


