<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\Labour;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;

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

        $labour->update([
            'department_id' => $request->input('department_id'),
            'flagged' => false,
            'posted' => false,
            'start' => $first->lessThan($second) ? $first : $second,
            'end' => $first->greaterThanOrEqualTo($first) ? $second : $first,
            'job' => $request->input('job') ?? "MISSING_JOB",
        ]);


       // dd( $request->all() );
    }




}