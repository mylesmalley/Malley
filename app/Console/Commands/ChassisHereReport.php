<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Log;
use Modules\Vehicles\Mail\ChassisHereEmail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;


class ChassisHereReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprint:chassis-here';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send out an email about chassis on the ground at Malley';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     *
     */
    public function handle(): void
    {

        $vehicles = Vehicle::select([
            'id','vin','work_order','malley_number','customer_number',
            'make','model','year','customer_name','work_order',
        ])
            ->when(  true, function( $query ){
                $query->whereHas('dates', function( Builder $query){
                    $query->where('name', '=' ,'arrival')
                        ->where('current', '=', true);
                });
            })
            ->when( true, function( $query ){
                $query->whereDoesntHave('dates', function( Builder $query){
                    $query->where('name', '=' ,'compound_exit')
                        ->where('current', '=', true);
                });

            })

            ->with('dates')
            ->where('created_at','>','2021-05-31')
            ->where('vin','!=','')
            ->orderBy('created_at', 'DESC')
            ->get();



        $results = [];

        foreach( $vehicles as $vehicle )
        {
            $result = [
                'id' => $vehicle->id,
                'identifier' => $vehicle->identifier,
                'vin' => $vehicle->vin,
                'customer_name' => $vehicle->customer_name,
                'make' => $vehicle->make,
                'model' => $vehicle->model,
                'year' => $vehicle->year,
                'arrival' => $vehicle->milestone('arrival'),
            ];


            $results[] = $result;
        }

        $results = json_decode( json_encode($results ) );







        foreach([
            'mmalley@malleyindustries.com'
                 ] as $email )
        {
            Mail::to( $email )
                ->send( new ChassisHereEmail( $email, $results ) );
        }

        Log::info("Sent chassis here emails");
    }
}
