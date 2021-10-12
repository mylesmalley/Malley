<?php

namespace Modules\Blueprint\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;


class UpgradeBlueprint implements ShouldQueue
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
        $this->blueprint->upgrade();
    }

    /**
     * @return WithoutOverlapping[]
     */
    public function middleware(): array
    {
        return [new WithoutOverlapping( $this->blueprint->id )];
    }
}
