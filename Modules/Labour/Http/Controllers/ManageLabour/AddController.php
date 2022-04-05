<?php

namespace Modules\Labour\Http\Controllers\ManageLabour;

use App\Models\Labour;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

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

        // return to the previous page but clear out the details
        return redirect( $request->fullUrlWithQuery([
            'selected_user'=>null,
            'labour_id' => null,
            'form_locked' => false,
            'mode' =>  null,
        ]));
       // dd( $request->all() );
    }


}