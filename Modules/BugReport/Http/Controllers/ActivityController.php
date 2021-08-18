<?php

namespace Modules\BugReport\Http\Controllers;


use Modules\BugReport\Mail\ActivitiesAssignedNotification;
use Modules\BugReport\Mail\NextTaskDueNotification;
use App\Models\BugReport;
use App\Models\BugReportActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Illuminate\Http\Request;

class ActivityController
{

    public function update( Request $request )
    {
    //    dd( $request->all(),  $request->input("title.1")  );

        $activities = [];

        $bug = bugReport::find( $request->bug_report_id );

        // loop through submitted activities
        foreach ( $request->id as $id )
        {
            // search to see if the activity exists based on the id provided
            $row = BugReportActivity::find( $id );

            // it does exist
            if ( $row )
            {
                // if the row has a title, update the whole row
                if ( $request->input("title.{$id}"))
                {
                    $row->update([
                        'title' => $request->input("title.{$id}"),
                        'assigned_user_id' => $request->input("assigned_user_id.{$id}"),
                        'sequence' =>$request->input("sequence.{$id}"),
                        'due_date' =>$request->input("due_date.{$id}"),
                        'bug_report_id' =>$request->input("bug_report_id"),
                        'completed' => $request->input("completed.{$id}") ? true : false,
                    ]);
                    $row->save();

                  //  $activities[] = $row;
                }
                // the row doesn't have a title, meaning it can be deleted
                else
                {
                    $row->delete();
                }
            }

            // the row submitted doesn't yet exist, so create it.
            else
            {
                // but only if a title is provided.
                if( $request->input("title.{$id}") )
                {
                    $new = BugReportActivity::create([
                        'title' =>  $request->input("title.{$id}"),
                        'assigned_user_id' => $request->input("assigned_user_id.{$id}") ?? Auth::user()->id,
                        // if a sequence is provided, use that. Otherwise use the next one in line.
                        'sequence' =>  $request->input("sequence.{$id}") ?? $bug->nextActivitySequence(),
                        'due_date' =>$request->input("due_date.{$id}") ?? null,
                        'complete' =>  $request->input("complete.{$id}") ?? 0,
                        'bug_report_id' =>$request->input("bug_report_id"),
                        'user_id' => Auth::user()->id
                    ]);

                    $new->save();
                    $activities[ $request->input("assigned_user_id.{$id}") ][] = $new;
                }

            }

        }



        foreach( $activities as $id => $newActivities )
        {
            $user = User::find( $id ) ;
            Mail::to( $user->email )
                ->send( new ActivitiesAssignedNotification( $user, $bug, $newActivities ) );
        }



        return redirect("/bugs/{$bug->id}");

    }

    public function inlineUpdate( Request $request )
    {
        $activity = BugReportActivity::find( $request->id );
        $activity->update([
            'completed' => $request->completed,
        ]);
        $activity->save();


        $nextActivities = $activity->bugReport->nextActivities ;

        if ( $nextActivities->count() ) // only continue if more activities are needed
        {
            foreach( $nextActivities as $next )
            {
                if ( $activity->assigned_user_id != $next->assigned_user_id)
                {
                    Mail::to( $next->assignedUser->email )
                        ->send( new NextTaskDueNotification( $activity->bugReport, $activity, $next ) );
                }

            }
        }
        else // maybe use this to trigger done email to brenton?
        {
            // nothing
        }

        return redirect()->back();
    }

}
