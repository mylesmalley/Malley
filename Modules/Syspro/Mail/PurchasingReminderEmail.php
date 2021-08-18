<?php

namespace Modules\Syspro\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PurchaseRequest;
use Illuminate\Database\Eloquent\Collection;

class PurchasingReminderEmail extends Mailable
{
    //use Queueable, SerializesModels;
    use SerializesModels;

    public $purch;

    /**
     * PurchasingReminderEmail constructor.
     * @param Collection $purchaseRequests
     */
    public function __construct( Collection $purchaseRequests )
    {
        $this->purch = $purchaseRequests;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build( )
    {
        return $this
            ->subject("Purchase Request Reminder.")
        //    ->from('purchaseRequests@blueprint.malleyindustries.com')
            ->view('syspro::purchasing.purchasingReminderEmail');
    }
}
