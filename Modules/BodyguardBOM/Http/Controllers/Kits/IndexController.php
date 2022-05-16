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

    /**
     * @return Response
     */
    public function show( Request $request ) : Response
    {
        $request->validate([
            'chassis' => 'alpha'
        ]);


        $query = DB::table('bg_kits');

        $chassis = $request->input('chassis') ?? null;


        $query->when($chassis, function( $query, $chassis ){
            $query->where('chassis', '=', $chassis );
        });


        return response()->view('bodyguardbom::kits.index',[
            'results' => $query->get(),
        ]);
    }


}


