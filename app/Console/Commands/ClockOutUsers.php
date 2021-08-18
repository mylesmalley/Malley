<?php

namespace App\Console\Commands;

//use App\Programs\SysproReports\Mail\PurchasingReminderEmail;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Modules\BugReport\Mail\DigestEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\User;

//use App\Programs\SysproReports\Models\PurchaseRequest;

class ClockOutUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprint:clock-out';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Force clock out all staff';

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

        $time = Carbon::now('America/Moncton')->toIso8601String();

        DB::table('labour')
            ->whereNull('end')
            ->update([
                'end' => $time,
                'flagged' => true,
            ]);

        return false;
    }
}
