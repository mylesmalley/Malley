<?php

namespace Modules\Vehicles\Jobs;

use App\Models\Vehicle;
use App\Models\VehicleDate;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\Middleware\WithoutOverlapping;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;
use Throwable;


class FordMilestoneUpdate implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public VehicleDate $date;
    public Vehicle $vehicle;

    public int $tries = 1;
    public int $backoff = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( VehicleDate $date )
    {
        $this->date = $date;
        $this->vehicle = Vehicle::find( $this->date->vehicle_id );
    }


    /**
     * Execute the job.
     *
     * @return void
     * @throws GuzzleException
     */
    public function handle()
    {
        $data = $this->date->freight_verify_api_payload();

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('malley.freight_verify_domain'),
            // You can set any number of default request options.
            'timeout'  => 5,
        ]);

        $response = null;

        try {
            $response = $client->request('POST',
                config('malley.freight_verify_domain').config('malley.freight_verify_endpoint'), [
                    'auth' => [config('malley.freight_verify_user'), config('malley.freight_verify_pass')],
                    'json' => $data,
                ]);
        } catch (GuzzleException $e)
        {
            Log::error("Guzzle error $e");
        }



        if ( $response->getStatusCode() === 200)
        {
            $this->date->update([
                'submitted_to_ford' => true,
            ]);
            Log::info("Vehicle {$this->date->vehicle_id} pinged Ford date {$this->date->id}");
        }
        else
        {
            Log::error("Vehicle {$this->date->vehicle_id} failed to ping Ford date {$this->date->id}");
        }

    }

    /**
     * @return WithoutOverlapping[]
     */
    public function middleware(): array
    {
        return [new WithoutOverlapping( $this->date->id )];
    }


    /**
     * @param Throwable $exception
     */
    public function failed(Throwable $exception)
    {
        Log::critical("Date {$this->date->id} FAILED to ping Ford" ,[ $exception ]);
        $this->date->update([
            'submitted_to_ford' => false,
        ]);
    }
}
