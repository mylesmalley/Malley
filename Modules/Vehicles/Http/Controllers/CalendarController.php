<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\VehicleDate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \Carbon\Carbon;


class CalendarController extends Controller
{
    /**

     */
    public function get( Request $request, string $title )
    {
        $dates = VehicleDate::where([
            ['title','=',$title],
            ['start','>=',Carbon::parse( $request->start )],
            ['start','<=', Carbon::parse( $request->end )],
                    ])->get();

        $formatted = [];
        foreach( $dates as $date )
        {
            $formatted[] = $date->toFullCalendarEvent();
        }


        return json_encode( $formatted );

    }

    public function show( string $title = "All" )
    {
        return view('vehicles::calendars.show', ['title'=>$title] );
    }

}
