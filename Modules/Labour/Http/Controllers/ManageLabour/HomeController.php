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
            'active_tab' => 'sometimes|string',
        ]);

        $start_date = $request->input('start_date')
            ?? Carbon::today()->format('Y-m-d');

        $end_date = $request->input('end_date') ?? null;
        $user_id = $request->input('user_id') ?? null;
        $department = $request->input('department') ?? 8; // production

        $active_tab = $request->input('active_tab')
            ?? 'all';

      //  188

        //dd( UserDay::get( User::find(188), $start_date ));
      //  dd( $request->all(), $active_tab );

        return response()
            ->view('labour::manage_labour.home', [
                'active_tab' => $active_tab,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'user_id' => $user_id,
                'department' => $department,
            ] );
    }



}
