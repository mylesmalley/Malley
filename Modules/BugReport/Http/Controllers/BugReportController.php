<?php

namespace Modules\BugReport\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use \Illuminate\View\View;
use App\Models\BugReport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use \Modules\BugReport\Mail\ThankYouEmail;
use \Modules\BugReport\Mail\BugReportSubmittedEmail;

class BugReportController extends Controller
{
    /**
     * @param Request $request
     */
	public function create( Request $request  )
	{
		$domain = explode( '.', $request->getHttpHost()  );

		if ($domain[0] !== 'blueprint')
		{
			return redirect( 'https://blueprint.malleyindustries.com/bugs/create' );
		}

		$malley = ( $domain[0] === 'index' || Auth::user()->is_malley_staff === true ) ? true : false;

		return view('bugreport::create', [ 'malley' => $malley, 'tool'=> $domain[0] ]);
	}


	/**
	 * @param Request $request
	 * @return RedirectResponse|Redirector
	 */
	public function store( Request $request )
	{
		$request->validate([
			'user_id' => 'required|int',
			'related_id' => 'nullable|int',
			'related_table' => 'nullable|string|max:50',
			'title' => "required|string|max:50",
			'user_notes' => "required|string",
			'type' => "nullable|string|max:50",
			'browser' => "nullable|string",
			'full_version' => "nullable|string|max:50",
			'major_version' => "nullable|string|max:50",
			'app_name' => "nullable|string|max:50",
			'user_agent' => "nullable|string|max:150",
			'os' => "nullable|string|max:50",
			'dev_notes' => "sometimes|string",
			'status'  => "required|string|max:50",
			'urgency' => "required|int",
			'program' => "required|string|max:50", // blueprint, index etc
			'url' => "nullable|string|max:1000", // try to get the route with the problem
			'upload.*' => 'nullable|min:1|mimes:png,jpg,jpeg,pdf|max:4096',

		]);
		$report = BugReport::create( $request->all() );

		$report->save();



		if($request->hasfile('upload')) {
			foreach($request->file('upload') as $image) {
				$report->addMedia($image)->toMediaCollection('uploads', 's3' );
			}
		}


		$url = base64_encode( $report->url );

		Mail::to( $request->email )
			->send( new ThankYouEmail( $report ) );

		$usersToReceive = [
			'mmalley@malleyindustries.com',
			'kayla@malleyindustries.com',
		];
		if (count($usersToReceive))
		{
			Mail::to( $usersToReceive )
				->send( new BugReportSubmittedEmail( $report ) );
		}

		return redirect("bugs/thankyou/{$url}");
	}


	/**
	 * @param string|null $url
	 * @return View
	 */
	public function thankyou( string $url = null ): View
	{
		return view('bugreport::thankyou', ['url' => $url ]);

	}

	/**
	 * @param Request $request
	 * @param BugReport $bug
	 */
	public function show( Request $request, BugReport $bug, string $mode = null )
	{

		// if on the blueprint subdomain, check if the user created the bug or is malley staff
		if ( Auth::user()->id === $bug->user_id || Auth::user()->is_malley_staff )
		{
		    $users = \App\Models\User::where('bug_report_assignable', true)->get();
			return view( 'bugreport::bug', ['bug' => $bug,
                'mode' => $mode,
                'users'=> $users ]);
		}

		// on failure of permission, redirect back to the thank you page.
		return redirect('bugs/thankyou');
	}






}
