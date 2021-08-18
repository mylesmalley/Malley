<?php

namespace Modules\BugReport\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BugReport;

class ProjectOnHoldEmail extends Mailable
{
	use Queueable, SerializesModels;

	public $bug;

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct( BugReport $bug )
	{
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
            ->subject("On Hold - {$this->bug->title}")
        //    ->from('bugReport@blueprint.malleyindustries.com')
			->view('bugreport::mail.projectOnHoldEmail');
	}
}
