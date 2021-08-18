<?php

namespace App\Console\Commands;

//use App\Programs\SysproReports\Mail\PurchasingReminderEmail;
use Modules\BugReport\Mail\DigestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

//use App\Programs\SysproReports\Models\PurchaseRequest;

class EngineeringDigestEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprint:engineering-digest';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out an email updating open engineering tasks';

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

//        if (date('H') == 16)
//        {
//            $reqs = PurchaseRequest::whereIn('status', [5, 4])
//                ->get();
//        }
//        else
//        {
//            $reqs = PurchaseRequest::whereIn('status', [5, 4, 3])
//                ->get();
//        }


//
//        if ( $reqs->count() )
//        {
//            $users = \App\User::where('can_edit_purchase_requests', true)->pluck('email');
//
//
//        }

        foreach( User::where('can_edit_purchase_requests', true)->get() as $user )
        {
            Mail::to( $user->email )
                ->send( new DigestEmail( $user ) );
        }

        return false;
    }
}
