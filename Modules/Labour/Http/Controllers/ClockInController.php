<?php

namespace Modules\Labour\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Labour;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class ClockInController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function clock_in( Request $request ): RedirectResponse
    {
//        $request->validate([
//            'id' => 'required|integer'
//        ]);

        $labour = Labour::create([
            'user_id' => Auth::user()->id,
            'start' => Carbon::now('America/Moncton')->toIso8601String(),
            'department_id' => Auth::user()->department_id,
            'job' => $request->input('job')
        ]);

        $labour->save();
        Cache::forget('_user_day_' . Auth::user()->id . '-' . Carbon::now('America/Moncton')->format('Y-m-d'));

        return redirect()->route('labour.home');
    }



}
