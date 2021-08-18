<?php

namespace Modules\BugReport\Http\Controllers;

use App\Http\Controllers\Controller;
use \Illuminate\View\View;
use App\Models\BugReport;
use Illuminate\Support\Facades\Auth;


class IndexController extends Controller
{


    /**
     * @return View
     */
    public function index(): View
    {
        $bugs = BugReport::orderBy('id','DESC')
            ->paginate(15);

        return view('bugreport::index', ['bugs' => $bugs ]);
    }


    /**
     * @return View
     */
    public function open(): View
    {
        $bugs = BugReport::orderBy('id','DESC')
            ->whereIn('status',['Open','On hold'])
            ->paginate(15);

        return view('bugreport::open', ['bugs' => $bugs ]);
    }


    /**
     * @return View
     */
    public function openBlueprint()
    {
        $bugs = BugReport::orderBy('id','DESC')
            ->whereIn('status',['Open','On hold'])
       //     ->where('status','Open')
            ->where('engineering_task', false)
            ->with('activities')
            ->paginate(15);

        return view('bugreport::list', ['bugs' => $bugs,
            'user' => Auth::user() ]);
    }

    /**
     * @return View
     */
    public function openEngineering(): View
    {
        $bugs = BugReport::whereIn('status',['Open','On hold'])
            ->whereIn('status',['Open','On hold'])
            ->where('engineering_task', true)
            ->with('activities','activities.assignedUser')
            ->orderBy('priority','DESC')
            ->paginate(15);

        return view('bugreport::list', ['bugs' => $bugs,
            'title' => "All Open Engineering Projects",
            'user' => Auth::user() ]);
    }


    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function unassigned(): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('bugreport::unassigned',[
            'engineering' => BugReport::where( 'engineering_task', true,)
                ->whereIn('status',['On hold','Open','On Hold'])
                ->where('assigned_user_id',null)
                ->get(),
            'blueprint' => BugReport::where( 'engineering_task', false,)
                ->whereIn('status',['On hold','Open','On Hold'])
                ->where('assigned_user_id',null)

                ->get(),
        ]);
    }

}
