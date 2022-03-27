<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Modules\Labour\Models\UserDay;

class HomeController extends Controller
{

    /**
     * @param Request $request
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

        $users = match ($active_tab) {
            'all' => $this->all_staff(),
            'department' => $this->by_department($department),
            'person' => [$user_id],
            default => [Auth::user()->id], // the user, barring anything else
        };



        $user_days = [];

        if ( $active_tab === 'all')
        {
            foreach( $users as $user )
            {
                $user_days[] = UserDay::get($user, $start_date );
            }

        }






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
                'user_days' => $user_days,
            ] );
    }



    /**
     * @param string $start
     * @param string $end
     * @return array
     */
    public function dates( string $start, string $end ): array
    {
        $dates = CarbonPeriod::create( $start, $end );
        $selectedDates = [];
        foreach( $dates as $d )
        {
            $selectedDates[] = $d->format('Y-m-d');
        }
        return $selectedDates;
    }



    /**
     * @return Collection
     */
    public function all_staff(): Collection
    {
        return User::role('labour')
            ->where('is_enabled', '=', true )
            ->select(['id','first_name','last_name','department_id'])
            ->orderBy('last_name')
            ->get();
    }


    /**
     * @param int $department_id
     * @return Collection
     */
    public function by_department( int $department_id ): Collection
    {
        return User::role('labour')
            ->select(['id','first_name','last_name','department_id'])
            ->where('department_id', '=', $department_id)
            ->where('is_enabled', true )
            ->orderBy('last_name')
            ->get();
    }

}
