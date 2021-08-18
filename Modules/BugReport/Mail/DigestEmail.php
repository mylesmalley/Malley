<?php

namespace Modules\BugReport\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BugReport;
use App\Models\User;

class DigestEmail extends Mailable
{
	//use Queueable, SerializesModels;
	use SerializesModels;

	public $bug;
	public $user;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( User $user )
	{
		$this->user = $user;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(  )
	{
	    $user = $this->user;

        $openBugs = BugReport::where('status','Open')
            ->orderBy('priority','DESC')
            ->whereHas('activities', function( $query ) use ( $user ){
                $query->where([[ 'completed','=',false],['assigned_user_id','=',$user->id ]]);
            })
            ->with('activities')
            ->get();

		return $this
            ->subject("Engineering Tasks Today")
	//		->from('bugReport@blueprint.malleyindustries.com')
			->view('bugreport::mail.digestEmail',[
			    'user' => $user,
			    'openBugs' => $openBugs,
            ]);
	}
}
