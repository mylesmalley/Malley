<?php

namespace Modules\Blueprint\Jobs;

use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use JetBrains\PhpStorm\Pure;
use Modules\Blueprint\Emails\DrawingCreated;
use App\Models\User;
use Illuminate\Queue\Middleware\ThrottlesExceptions;
use Throwable;


class EmailDrawingPackage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Blueprint $blueprint;
    protected User $user;

    /**
     * @param Blueprint $blueprint
     * @param User $user
     */
    public function __construct( Blueprint $blueprint, User $user )
    {
        $this->blueprint = $blueprint;
        $this->user = $user;

        if ( ! $user->email ) die("No email available to send drawings to");
    }



    /**
     * @return ThrottlesExceptions[]
     */
    #[Pure] public function middleware(): array
    {
        return [new ThrottlesExceptions(2, 1)];
    }

    /**
     * Determine the time at which the job should timeout.
     *
     * @return DateTime
     */
    public function retryUntil(): DateTime
    {
        return now()->addMinutes(2);
    }


    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        $media = $this
            ->blueprint
            ->getMedia('drawing')
            ->last();

        $usersToReceive = [ $this->user->email, 'mmalley@malleyindustries.com' ];
        if (count($usersToReceive))
        {
            Mail::to( $usersToReceive )
                ->send( new DrawingCreated( $this->blueprint, $media ) );
            Log::info("Email dispatch succeeded for B-{$this->blueprint->id} ",[ $usersToReceive]);

        }
        else
        {
            Log::error("Email dispatch failed. No emails available to receive B-{$this->blueprint->id}");

        }


    }

    /**
     * @param Throwable $exception
     */
    public function failed(Throwable $exception)
    {
        Log::error("Email send failed ",[ $exception]);
    }
}
