<?php

namespace Modules\Labour\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Labour;
use Illuminate\Support\Facades\Cache;

class ClockOutController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function clock_out( Request $request ): RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer'
        ]);

        $labour =  Labour::find( $request->input('id'));

        Cache::forget('_user_day_' . $labour->user_id . '-' . $labour->start->format('Y-m-d'));

        $labour->finish();

        return redirect()->route('labour.home');
    }



}
