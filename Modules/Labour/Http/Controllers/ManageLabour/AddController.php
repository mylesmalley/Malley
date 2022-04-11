<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\Labour;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class AddController extends Controller
{
    use ParsesTimeTrait;


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Request $request ): RedirectResponse
    {

        $request->validate([
            "referer_url" => "required|string",
            "user_id" => "required|integer",
            "date" => "required|date",
            "start_hours" => "required|integer",
            "start_minutes" => "required|integer",
            "start_ampm" => "required|string",
            "end_hours" => "required|integer",
            "end_minutes" => "required|integer",
            "end_ampm" => "required|string",
            "department_id" => "required|integer",
            "job" => "required|string",
        ]);


        $first = $this->parse_time(
            $request->input('date'),
            $request->input('start_hours'),
            $request->input('start_minutes'),
            $request->input('start_ampm')
        );

        $second = $this->parse_time(
            $request->input('date'),
            $request->input('end_hours'),
            $request->input('end_minutes'),
            $request->input('end_ampm')
        );


        $details = [
            'user_id' => $request->input('user_id'),
             'job' => $request->input('job') ?? "MISSING_JOB",
            'department_id' => $request->input('department_id'),
            'flagged' => false,
            'posted' => false,
            'start' => $first->lessThan($second) ? $first->format('c') : $second->format('c'),
            'end' => $first->greaterThanOrEqualTo($first) ? $second->format('c') : $first->format('c'),
        ];

        try {
            $l = Labour::create( $details );
            Log::info("User ".Auth::user()->id." saved a new labour record for user {$request->input('user_id')} " . $l->id);
            Cache::forget('_user_day_' . $request->input('user_id') . '-' . $request->input('date'));

        }
        catch ( Exception $e )
        {
            Log::info("Error creating labour record for user {$request->input('user_id')}" , $e);

        }


        $referer =  parse_url( $request->input('referer_url'), PHP_URL_QUERY );
        $query_string = [];
        parse_str( $referer, $query_string );
        //dd( $query_string );

        return redirect()->route('labour.management.home',[
            "active_tab" => $query_string["active_tab"] ?? "all",
            "selected_date" => $request->input('date'),
        ]);
    }


}