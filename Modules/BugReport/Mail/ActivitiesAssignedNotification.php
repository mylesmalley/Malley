<?php

namespace Modules\BugReport\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\User;
use App\Models\BugReport;

class ActivitiesAssignedNotification extends Mailable
{
	use Queueable, SerializesModels;

	public $user;
    public $activities;
    public $bug;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( User $user, BugReport $bug, array $activities )
	{
        $this->user = $user;
        $this->activities = $activities;
        $this->bug = $bug;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build( )
	{
		return $this
			->subject("You have been assigned work.")
   //         ->from('bugReport@blueprint.malleyindustries.com')
			->view('bugreport::mail.newActivityNotification');
	}
}
