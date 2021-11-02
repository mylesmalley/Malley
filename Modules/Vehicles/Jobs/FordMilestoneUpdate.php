<?php

namespace Modules\Vehicles\Jobs;

use App\Models\VehicleDate;
use GuzzleHttp\Client;
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

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( VehicleDate $date )
    {
        $this->date = $date->load('vehicle');
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info("Vehicle {$this->date->vehicle_id} pinged Ford");


        $data = [
            "vin" => $this->date->vehicle->vin,
            "code" => VehicleDate::ford_milestone_code($this->date->name),
            "statusUpdateTs" => $this->date->timestamp,
            "references" => [
                [
                    "qualifier" => "senderName",
                    "value" => "Malley Industries Inc."
                ],
                [
                    "qualifier" => "receiverCode",
                    "value" => "FORDIT",
                ],
                [
                    "qualifier" => "scac",
                    "value" => "MALLEY",
                ],
                [
                    "qualifier" => "ms1LocationCode",
                    "value" => "DIEPPE",
                ],
                [
                    "qualifier" => "ms1StateOrProvinceCode",
                    "value" => "NB",
                ],
                [
                    "qualifier" => "ms1CountryCode",
                    "value" => "Canada",
                ],
                [
                    "qualifier" => "compoundCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "yardCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "bayCode",
                    "value" => "NA",
                ],
                [
                    "qualifier" => "partnerType",
                    "value" => "UP",
                ]
            ]

        ];

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => config('malley.freight_verify_domain'),
            // You can set any number of default request options.
            'timeout'  => 5,
        ]);

        $response = $client->request('POST',
            config('malley.freight_verify_endpoint'), [
                'auth' => [config('malley.freight_verify_user'), config('malley.freight_verify_pass')],
                'json' => $data,
            ]);


        if ( $response->getStatusCode() === 200)
        {
            $this->date->update([
                'submitted_to_ford' => true,
            ]);
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
        Log::critical("Vehicle {$this->date->id} FAILED to ping Ford" ,[ $exception]);
        $this->date->update([
            'submitted_to_ford' => false,
        ]);
    }
}
