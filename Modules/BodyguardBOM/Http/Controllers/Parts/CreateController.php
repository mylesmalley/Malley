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
            'part_codes' => $this->part_codes,
            'chassis' => $this->chassis,
            'locations' => $this->part_locations,
        ]);
    }

//
//
//    public function store( Request $request ) : RedirectResponse
//    {
//        $request->validate([
//            'part_number' => 'required|string|max:255',
//            'description' => 'required|string|max:255',
//            'category' => 'required',
//            'colour' => 'required',
//            'kit_code' => 'required',
//            'chassis' => 'required',
//            'roof_height' => 'required',
//        ]);
//
//        $kit = Kit::create( $request->only([
//            'part_number',
//            'description',
//            'colour',
//            'category',
//            'kit_code',
//            'roof_height',
//            'category',
//            'chassis',
//        ]));
//
//
//        $kit->create_phantom_in_syspro();
//
//
//
//
//
//
//
//
//
//        return redirect( )
//            ->route('bg.kits.home', [
//                'chassis' => $request->input('chassis'),
//                'roof_height' => $request->input('roof_height'),
//                'kit_code' => $request->input('kit_code'),
//                'colour' => $request->input('colour'),
//            ]);
//    }



}


