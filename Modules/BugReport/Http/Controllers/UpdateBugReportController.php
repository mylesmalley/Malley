<?php

namespace Modules\BugReport\Http\Controllers;


use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\BugReport;
use Modules\BugReport\Mail\ProjectOnHoldEmail;
use Illuminate\Routing\Redirector;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

class UpdateBugReportController
{

	/**
	 * @param Request $request
	 * @param BugReport $bugReport
	 * @return RedirectResponse|Redirector
	 */
	public function update( Request $request, BugReport $bugReport )
	{
		$request->validate([
			'dev_notes' => "nullable|string",
			"status" => "required|string",
            'user_notes' => 'string',
            'due_date' => 'date|nullable',
            "assigned_user_id" => "nullable|integer"
		]);

//		dd( $request->all() );


     //   dd( $bugReport );

        if ( $request->status === "On hold")
        {
            $users = User::whereIn('id', $bugReport->activities()
                ->where('completed',false)
                ->pluck('assigned_user_id')
                ->unique() )->get();


            if ($users->count() )
            {
                Mail::to( $users->pluck('email') )
                    ->send( new ProjectOnHoldEmail( $bugReport ) );
            }

        }

        //hello world
		$bugReport->update( $request->all() );
		$bugReport->save();


		return redirect( "/bugs/{$bugReport->id}");
	}
}
