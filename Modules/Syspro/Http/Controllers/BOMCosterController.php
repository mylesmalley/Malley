<?php

namespace Modules\Syspro\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\Request;

class BOMCosterController extends Controller
{

    /**
     * @param Request $request
     * @param string|null $stockCode
     * @return View
     */
    public function show( Request $request, string $stockCode = null ): View
    {
        $code = $stockCode ?? $request->stockCode ?? null;

        $parts = DB::connection('syspro')
            ->table(DB::raw( "dbo.BLUEPRINT_BOM_CHILDREN( ? )" ) )
            ->select('*')
            ->setBindings([ $code ])
            ->orderBy('SRC', 'ASC')
            ->get();

        return view('syspro::BOMCoster', [
            'stockCode' => $code,
            'parts' => $parts
        ]);
    }

}
