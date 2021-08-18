<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Labour;

class FlagController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function toggleFlag(  Request $request ): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        Labour::find( $request->input('id'))->toggleFlag();

        return redirect()->route('labour.home');
    }



}
