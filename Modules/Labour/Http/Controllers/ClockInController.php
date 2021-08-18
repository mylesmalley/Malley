<?php

namespace Modules\Labour\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use App\Models\Labour;
use Illuminate\Support\Facades\Auth;

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

        return redirect()->route('labour.home');
    }



}
