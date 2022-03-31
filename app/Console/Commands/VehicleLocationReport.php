<?php

namespace App\Console\Commands;

use App\Models\Vehicle;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\Vehicles\Mail\VehicleLocationEmail;

class VehicleLocationReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprint:vehicle-locations';

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

    public function handle(): void
    {
        $matches = Vehicle::whereIn('location', ['At Malley', 'Off site; coming back'])
            ->select(['id','vin','make','model','year','location','work_order'])
            ->with(['dates' => function($query){
                $query
                    ->where('location','!=', null)
                    ->where('timestamp', '<=', Carbon::today());
            },'dates.user'])
            ->get();



        foreach ([
            'mmalley@malleyindustries.com',
            'tmalley@malleyindustries.com',
            'dpargiter@malleyindustries.com',
            'jbourque@malleyindustries.com',
            'kmalley@malleyindustries.com',
            'bcroucher@malleyindustries.com',
            'CDeveau@malleyindustries.com',
            'MarcALeblanc@malleyindustries.com',
            'kprasad@malleyindustries.com',
            'vhinojosa@malleyindustries.com',
        ] as $email) {
            Mail::to($email)
                ->send(new VehicleLocationEmail($email, $matches));
        }

        Log::info('Sent vehicle location report emails');
    }
}
