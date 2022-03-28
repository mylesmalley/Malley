<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\Labour;
use Carbon\Carbon;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

class AddController extends Controller
{


    public function add( Request $request )
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
          //  "job" => "required|string",
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



        Labour::create([
            'user_id' => $request->input('user_id'),
           // 'job' => $request->input('job'),
            'department_id' => $request->input('department_id'),
            'flagged' => false,
            'posted' => false,
            'start' => $first->lessThan($second) ? $first : $second,
            'end' => $first->greaterThanOrEqualTo($first) ? $second : $first,
            'job' => "TEST",
        ]);


       // dd( $request->all() );
    }


    /**
     * @param string $date
     * @param string $hours
     * @param string $minutes
     * @param string $ampm
     * @return Carbon
     */
    private function parse_time( string $date, string $hours, string $minutes, string $ampm): Carbon
    {

        $newEndString = $date . ' ' .
            $hours . ":" .
            str_pad($minutes, 2, '0', STR_PAD_LEFT)
            . ' ' . $ampm;

        return Carbon::parse($newEndString, 'America/Moncton');
    }

}