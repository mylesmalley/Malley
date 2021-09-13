<?php

namespace Modules\Blueprint\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\Mail;
use Modules\Blueprint\Emails\BlueprintCreatedNotification;


class EmaiStaffAboutBlueprintCreation implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Blueprint $blueprint;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Blueprint $blueprint )
    {
        $this->blueprint = $blueprint;
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //$usersToReceive = User::where('email_when_blueprint_created', true)->pluck('email');
        $usersToReceive = ['mmalley@malleyindustries.com','myles@mylesmalley.ca'];
        if (count($usersToReceive))
        {
            Mail::to( $usersToReceive )
                ->send( new BlueprintCreatedNotification( $this->blueprint ) );

        }
    }
}
