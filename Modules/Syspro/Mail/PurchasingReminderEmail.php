<?php

namespace Modules\Syspro\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;

class PurchasingReminderEmail extends Mailable
{
    use SerializesModels;

    public Collection $purchaseRequests;

    /**
     * @param Collection $purchaseRequests
     */
    public function __construct( Collection $purchaseRequests )
    {
        $this->purchaseRequests = $purchaseRequests;
    }

    /**
     * @return PurchasingReminderEmail
     */
    public function build( ): PurchasingReminderEmail
    {
        return $this
            ->subject("Purchase Request Reminder.")
        //    ->from('purchaseRequests@blueprint.malleyindustries.com')
            ->view('syspro::purchasing.purchasingReminderEmail');
    }
}
