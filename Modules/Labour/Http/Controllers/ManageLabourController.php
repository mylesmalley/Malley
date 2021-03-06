<?php

namespace Modules\Labour\Http\Controllers;

use App\Models\Labour;
use App\Http\Controllers\Controller;
use App\Models\User;
use Carbon\CarbonPeriod;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;

class ManageLabourController extends Controller
{

    /**
     * @param Request $request
     * @return Response
     * @throws AuthorizationException
     */
    public function home( Request $request ): Response
    {
        $this->authorize('labour_edit', Labour::class);

        $request->validate([
            'start' => 'sometimes|date',
            'end' => 'sometimes|date',
            'filter' => 'sometimes|string',
            'user' => 'sometimes|int',
            'department' => 'sometimes|integer',

        ]);


        $start = $request->input('start') ?? date('Y-m-d');
        $end = $request->input('end') ?? $start;
        // sort the dates
        $dates = $this->dates( min( $start, $end), max( $start, $end ));


        $filter = $request->input('filter') ?? 'all';
        $user = $request->input('user') ?? Auth::user()->id;
        $department = $request->input('department') ?? 1;
      //  $selectedUser = $request->input('selected_user') ?? null;


        //Tab handling
        $tab = $filter;

        // route which users should be pulled in
        $users = match ($filter) {
            'all' => $this->all_staff(),
            'department' => $this->by_department($department),
            'person' => [$user],
            default => [Auth::user()->id], // the user, barring anything else
        };

        return response()
            ->view('labour::management.home', [
                'dates' => $dates,
                'user_ids' => $users,
                'activeTab' => $tab,
                'selectedUser' => null,
                'selectedDate' => null,

            ]);
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
     * @return array
     */
    public function all_staff(): array
    {
        return User::role('labour')
            ->where('is_enabled', '=', true )
            ->select(['id','first_name','last_name','department_id'])
            ->orderBy('last_name')
            ->pluck('id')
            ->toArray();
    }


    /**
     * @param int $department_id
     * @return array
     */
    public function by_department( int $department_id ): array
    {
        return User::role('labour')
            ->select(['id','first_name','last_name','department_id'])
            ->where('department_id', '=', $department_id)
            ->where('is_enabled', true )
            ->orderBy('last_name')
            ->pluck('id')
            ->toArray();
    }


}
