<?php

namespace Modules\Blueprint\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Blueprint;


class ResetRenderTemplates implements ShouldQueue
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
       // dd('fired!');
        $this->blueprint->resetRenderTemplates();
    }
}
