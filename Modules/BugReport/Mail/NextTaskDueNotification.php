<?php

namespace Modules\BugReport\Mail;

use App\Models\BugReportActivity;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\BugReport;
use App\Models\User;

class NextTaskDueNotification extends Mailable
{
	//use Queueable, SerializesModels;
	use SerializesModels;

    public $bug;
    public $previousActivity;
    public $nextActivity;

    /**
     * NextTaskDueNotification constructor.
     * @param BugReport $bug
     * @param BugReportActivity $previousActivity
     * @param BugReportActivity $nextActivity
     */
	public function __construct( BugReport $bug, BugReportActivity $previousActivity, BugReportActivity $nextActivity)
	{
        $this->bug = $bug;
        $this->previousActivity = $previousActivity;
        $this->nextActivity = $nextActivity;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build(  )
	{

		return $this
            ->subject("Next up on {$this->bug->title}")
			->view('bugreport::mail.nextUpEmail',[
                'bug' => $this->bug,
                'user' => $this->nextActivity->assignedUser,
                'nextActivity' => $this->nextActivity,
                'previousActivity' => $this->previousActivity,
            ]);
	}
}
