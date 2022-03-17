<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\BugReport\Mail\DigestEmail;

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

    public function handle(): void
    {
        foreach (User::where('can_edit_purchase_requests', true)->get() as $user) {
            Mail::to($user->email)
                ->send(new DigestEmail($user));
        }

        Log::info('Sent engineering digest emails');
    }
}
