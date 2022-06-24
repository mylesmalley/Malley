<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    use PartNumberComponentsTrait;

    /**
     * @param Request $request
     * @return Response
     */
    public function show( Request $request ) : Response
    {
        $request->validate([
            'chassis' => 'sometimes|alpha_num',
            'roof_height' => 'sometimes|alpha_num',
            'type' => 'sometimes|alpha_num',
        ]);


        $query = DB::table('bg_kits');

        $chassis = ( $request->input('chassis' ) === "ALL")
            ? null : $request->input('chassis' );



        $query->when($chassis, function( $query ) use ($chassis){
            if (strlen($chassis) === 3)
            {
                $query->where('chassis', 'like', "$chassis%" );
            }
            else
            {
                $query->where('chassis', '=', $chassis );
            }
        });


        $roof_height = ( $request->input('roof_height' ) === "ALL")
            ? null : $request->input('roof_height' );

        $query->when($roof_height, function( $query ) use ($roof_height){
            $query->where('roof_height', '=', $roof_height );
        });


        $kit_code = ( $request->input('kit_code' ) === "ALL")
            ? null : $request->input('kit_code' );

        $query->when($kit_code, function( $query ) use ($kit_code){
            $query->where('kit_code', '=', $kit_code );
        });


        $colour = ( $request->input('colour' ) === "ALL")
            ? null : $request->input('colour' );

        $query->when($colour, function( $query ) use ($colour){
            $query->where('colour', '=', $colour );
        });

        return response()->view('bodyguardbom::kits.index',[
//            'query' => $query->dump(),
            'results' => $query->get(),
            'prefixes' => $this->prefix,
            'colours' => $this->colours,
            'roof_heights' => $this->roof_heights,
            'kit_codes' => $this->kit_codes,
            'chassis' => $this->chassis,
        ]);
    }


}


