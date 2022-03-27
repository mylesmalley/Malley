<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Modules\Labour\Models\UserDay;

class HomeController extends Controller
{

    /**
     * @return Response
     */
    public function home( Request $request ): Response
    {
        $request->validate([
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date|required_with:start_date',
            'user_id' => 'sometimes|integer',
            'department' => 'sometimes|integer',
        ]);

        $start_date = $request->input('start_date')
            ?? Carbon::today()->format('Y-m-d');

      //  188

        //dd( UserDay::get( User::find(188), $start_date ));


        return response()
            ->view('labour::manage_labour.home' );
    }



}
