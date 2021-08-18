<?php

namespace App\Console\Commands;

use \Modules\Syspro\Mail\PurchasingReminderEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

use App\Models\PurchaseRequest;

class PurchaseRequestReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprint:purchases';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send emails about open purchase requests';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        // catch orders that have been received, waiting on updates, or on hold for some other reason

        if (date('H') == 16)
        {
            $reqs = PurchaseRequest::whereIn('status', [5, 4])
                ->get();
        }
        else
        {
            $reqs = PurchaseRequest::whereIn('status', [5, 4, 3])
                ->get();
        }



        if ( $reqs->count() )
        {
            $users = \App\Models\User::where('can_edit_purchase_requests', true)->pluck('email');

            Mail::to( $users )
                ->send( new PurchasingReminderEmail( $reqs ) );
        }

        return false;
    }
}
