<?php

namespace Modules\BugReport\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\BugReport;

class ThankYouEmail extends Mailable
{
	//use Queueable, SerializesModels;
	use SerializesModels;

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
            ->subject("Submitted: {$this->bug->title}")
	//		->from('bugReport@blueprint.malleyindustries.com')
			->view('bugreport::thankYouEmail');
	}
}
