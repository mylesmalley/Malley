<?php

namespace Modules\Syspro\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\PurchaseRequest;

class RequestUpdateEmail extends Mailable
{
    //use Queueable, SerializesModels;
    use SerializesModels;

    public $req;

    /**
     * sThankYouEmail constructor.
     * @param PurchaseRequest $req
     */
    public function __construct( PurchaseRequest $req )
    {
        $this->req = $req;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build( )
    {
        return $this
            ->subject("Purchase Request Update.")
       //     ->from('purchaseRequests@blueprint.malleyindustries.com')
            ->view('syspro::purchasing.requestUpdateEmail');
    }
}
