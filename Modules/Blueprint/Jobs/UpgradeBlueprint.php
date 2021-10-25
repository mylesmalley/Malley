<?php

namespace Modules\Blueprint\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;
use Illuminate\Support\Facades\Log;


class UpgradeBlueprint implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

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
        Log::info("Refreshing B-{$this->blueprint->id}");
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
