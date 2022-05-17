<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Illuminate\Support\Facades\DB;
use Modules\BodyguardBOM\Models\Category;
use Modules\BodyguardBOM\Models\Part;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use function Clue\StreamFilter\fun;

class IndexController extends Controller
{
    use PartNumberComponentsTrait;

    /**
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
                $query->where('chassis', 'like', "{$chassis}%" );
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


        $type = ( $request->input('type' ) === "ALL")
            ? null : $request->input('type' );

        $query->when($type, function( $query ) use ($type){
            $query->where('type', '=', $type );
        });


        $colour = ( $request->input('colour' ) === "ALL")
            ? null : $request->input('colour' );

        $query->when($colour, function( $query ) use ($colour){
            $query->where('colour', '=', $colour );
        });

        return response()->view('bodyguardbom::kits.index',[
            'query' => $query->dump(),
            'results' => $query->get(),
            'prefixes' => $this->prefix,
            'colours' => $this->colours,
            'roof_heights' => $this->roof_heights,
            'kit_codes' => $this->kit_codes,
            'wheelbases' => $this->wheelbases,
        ]);
    }


}


