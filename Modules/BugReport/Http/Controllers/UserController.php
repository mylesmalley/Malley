<?php

namespace Modules\BugReport\Http\Controllers;


use App\Models\BugReport;
use App\Models\BugReportActivity;
use \App\Models\User;
use \Illuminate\View\View;

class UserController
{

    /**
     * @param User $user
     * @return View
     */
    public function show( User $user ): View
    {
//        $bugIds = BugReportActivity::distinct()
//            ->where('assigned_user_id',$user->id )
//            ->pluck('bug_report_id');

        $openBugs = BugReport::where('status','Open')
            ->orderBy('priority','DESC')
            ->whereHas('activities', function( $query ) use ($user){
                $query->where([[ 'completed','=',false],['assigned_user_id','=',$user->id ]]);
            })
            ->with('activities')
            ->get();

        $onHoldBugs = BugReport::where('status','On hold')
            ->orderBy('priority','DESC')
            ->whereHas('activities', function( $query ) use ($user){
                $query->where([[ 'completed','=',false],['assigned_user_id','=',$user->id ]]);
            })
            ->with('activities')
            ->get();

        return view('bugreport::user',[
            'users' => User::where(['bug_report_assignable'=> true] )->withCount('bugReportTasks')->get(),
            'user' => $user,
            'openBugs' => $openBugs,
            'onHoldBugs' => $onHoldBugs,
        ]);


    }
}
