<?php

namespace Modules\Index\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Option;
use Illuminate\Support\Facades\Log;


class CreateOptionRevision implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue,
        Queueable, SerializesModels, Batchable;

    protected Option $option;


    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Option $option )
    {
        $this->option = $option;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Creating revision for Option {$this->option->id}");
       // $this->blueprint->upgrade();
    }

    /**
     * @return WithoutOverlapping[]
     */
    public function middleware(): array
    {
        return [new WithoutOverlapping( $this->option->id )];
    }
}
