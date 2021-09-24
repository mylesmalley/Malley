<?php

namespace Modules\Blueprint\Jobs;

use App\Models\Media;
use DateTime;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\Mail;
use Modules\Blueprint\Emails\DrawingCreated;
use App\Models\User;
use Mpdf\MpdfException;
use Illuminate\Queue\Middleware\ThrottlesExceptions;


class EmailDrawingPackage implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected Blueprint $blueprint;
    protected User $user;

    /**
     * @param Blueprint $blueprint
     * @param User $user
     * @param Media $media
     */
    public function __construct( Blueprint $blueprint, User $user, Media $media)
    {
        $this->blueprint = $blueprint;
        $this->user = $user;
        $this->media = $media;

        if ( ! $user->email ) die("No email available to send drawings to");
    }



    /**
     * @return ThrottlesExceptions[]
     */
    public function middleware(): array
    {
        return [new ThrottlesExceptions(5, 2)];
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

        $media = $this->media;

        $usersToReceive = [ $this->user->email, 'mmalley@malleyindustries.com' ];
        if (count($usersToReceive))
        {
            Mail::to( $usersToReceive )
                ->send( new DrawingCreated( $this->blueprint, $media ) );
        }
    }
}
