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
            'chassis' => 'alpha_num'
        ]);


        $query = DB::table('bg_kits');

//        $chassis = $request->input('chassis' );
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


