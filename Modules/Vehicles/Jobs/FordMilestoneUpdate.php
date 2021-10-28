<?php

namespace Modules\Vehicles\Jobs;

use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Log;
use Throwable;


class FordMilestoneUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public Vehicle $vehicle;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Vehicle $vehicle )
    {
        $this->vehicle = $vehicle;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Vehicle {$this->vehicle->id} pinged Ford");
    }

    /**
     * @return WithoutOverlapping[]
     */
    public function middleware(): array
    {
        return [new WithoutOverlapping( $this->vehicle->id )];
    }


    /**
     * @param Throwable $exception
     */
    public function failed(Throwable $exception)
    {
        Log::critical("Vehicle {$this->vehicle->id} pinged Ford" ,[ $exception]);
    }
}
