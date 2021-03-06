<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\Labour;
use Carbon\Carbon;
use Exception;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class EditController extends Controller
{
    use ParsesTimeTrait;

    public function edit( Request $request )
    {
        $request->validate([
            'labour_id' => 'required|integer',
            "referer_url" => "required|string",
            "user_id" => "required|integer",
            "date" => "required|date",
            "start_hours" => "required|numeric",
            "start_minutes" => "required|numeric",
            "start_ampm" => "required|string",
            "end_hours" => "required|numeric",
            "end_minutes" => "required|numeric",
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

        $labour = Labour::find( $request->input('labour_id') );




        try {
            $labour->update([
                'department_id' => $request->input('department_id'),
                'flagged' => false,
                'posted' => false,
                'start' => $first->lessThan($second) ? $first->format('c') : $second->format('c'),
                'end' => $first->greaterThanOrEqualTo($first) ? $second->format('c') : $first->format('c'),
                'job' => $request->input('job') ?? "MISSING_JOB",
            ]);


            Log::info("User ".Auth::user()->id." made a change to $labour->id for user $labour->user_id ");
            Cache::forget('_user_day_' . $labour->user_id . '-' . $request->input('date'));

        }
        catch ( Exception $e )
        {
            Log::info("Error creating labour record for user {$request->input('user_id')}" , $e);

        }

        $referer =  parse_url( $request->input('referer_url'), PHP_URL_QUERY );
        $query_string = [];
        parse_str( $referer, $query_string );

        return redirect()->route('labour.management.home',[
            "active_tab" => $query_string["active_tab"] ?? "all",
            "selected_date" => $request->input('date'),
            "start_date" => $request->input('date'),
            "end_date" => $request->input('date'),
        ]);
    }


    public function delete( Request $request )
    {
        $request->validate([
            'active_tab' => 'sometimes|string',
            'selected_date' => 'sometimes|date',
            'start_date' => 'sometimes|date',
            'end_date' => 'sometimes|date',
            'labour_id' => 'required|integer',
            'date' => 'required|date',
        ]);

//        dd( $request->all() );

        $labour = Labour::find( $request->input('labour_id') );


        Log::info("User ".Auth::user()->id." made a change to $labour->id");
        Cache::forget('_user_day_' . $labour->user_id . '-' . $request->input('date'));

        $labour->delete();


        return redirect()->route('labour.management.home',[
            "active_tab" => $query_string["active_tab"] ?? "all",
            "selected_date" => $request->input('date'),
            "start_date" => $request->input('date'),
            "end_date" => $request->input('date'),
        ]);
    }


    public function clock_out( Request $request )
    {
        $labour = Labour::find( $request->input('labour_id') );
        $now = Carbon::now('America\Moncton');


        if ( $labour->end === null)
        {
            $labour->update([
                'end' => $now->format('c'),
            ]);
            Log::info("User ".Auth::user()->id." made a change to $labour->id");
            Cache::forget('_user_day_' . $labour->user_id . '-' . $now->format('Y-m-d'));
        }
        else
        {
            Log::info("Did not clock out labour id $labour->id as an end time was already present");
        }



        return redirect()->route('labour.management.home',[
            "active_tab" => $query_string["active_tab"] ?? "all",
            "selected_date" => $request->input('date'),
            "start_date" => $request->input('date'),
            "end_date" => $request->input('date'),
        ]);
    }

}