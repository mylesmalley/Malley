<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\Labour;
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
            'mode' => 'sometimes|string',
            'form_locked' => "sometimes|boolean",
            'labour_id' => 'sometimes|integer',
        ]);

        // set useful defaults
        $start_date = $request->input('start_date')
            ?? Carbon::today('America/Moncton')->format('Y-m-d');

        $end_date = $request->input('end_date')
            ?? Carbon::today('America/Moncton')->format('Y-m-d');

        $user_id = $request->input('user_id')
            ?? null;

        $selected_user = $request->input('selected_user')
            ? User::find($request->input('selected_user'))
            : null;

        $selected_date = $request->input('selected_date')
            ? $request->input('selected_date')
            : null;




        $department = $request->input('department')
            ?? 8; // production

        $active_tab = $request->input('active_tab')
            ?? 'all';

        $form_locked = $request->input('form_locked') ?? false;

        $mode = $request->input('mode') ?? null;

        // labour record for editing
        $labour = $request->has('labour_id')
            ? Labour::find( (int) $request->input('labour_id') )
            : null;

        // which users should we grab?
        $users = match ($active_tab) {
            'all' => $this->all_staff(),
            'department' => $this->by_department($department),
            'person' => [$user_id],
            default => [Auth::user()->id], // the user, barring anything else
        };



        $user_days = [];

        // same day, different user
        if ( $active_tab === 'all' || $active_tab === 'department')
        {
            foreach( $users as $user )
            {
                $user_days[] = UserDay::get($user, $start_date );
            }
        }

        // same user, different days
        if ( $active_tab === 'person' && $user_id )
        {
            $dates = $this->dates( $start_date, $end_date );

            foreach( $dates as $date )
            {
                $user_days[] = UserDay::get(User::find($user_id), $date );
            }
        }


        return response()
            ->view('labour::manage_labour.home', [
                'active_tab' => $active_tab,
                'start_date' => $start_date,
                'end_date' => $end_date,
                'user_id' => $user_id,
                'department' => $department,
                'user_days' => $user_days,
                'mode' => $mode,
                'form_locked' => $form_locked, // prevent links and buttons appearing when a form is being edited
                'selected_user' => $selected_user, // for filling out add labour and edit labour forms
                'selected_date' => $selected_date,
                'labour' => $labour,
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
