<?php /** @noinspection PhpUnused */

namespace App\Programs\Vehicles\Controllers\Importing;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Inspection;

class LinkVinsToInspections extends Controller
{


    public function fix()
    {
        // get all vins
        $vehicles = Vehicle::where('vin', '!=', '')
            ->pluck('vin');

        // filter bad vins out
        $correctVins = $vehicles->filter(function($value, $key){
            return Vehicle::validVin($value);
        });

        $correctVins->toArray();

        // get inspections with no valid vin found
        $badVins = Inspection::where('vehicle_id', null)
                ->where('vin','!=', null)
                ->pluck('vin');


        $shouldBe = [];

        // loop through each inspection with an invalid vin
        foreach( $badVins as $check )
        {

            $options = [];

            foreach( $correctVins as $vin )
            {
                $closeness = 0;
                similar_text($vin, $check, $closeness);
                $options[$vin] = $closeness;

            }

            // sort to get the highest value match on top
            arsort( $options );

            // get the highest value
            $changeTo =  array_slice($options, 0, 1, true);

            // save to array
            $shouldBe[ $check ] = key( $changeTo );

        }

        foreach( $shouldBe as $old => $new )
        {
            Inspection::where('vin', $old)->update(['vin'=>$new] );
            echo "updated ".$old.' to '. $new.'\r\n';
        }

//        dd( $shouldBe );
    }





    public function match_wo()
    {

        $inspections = Inspection::where('vehicle_id', null)
            ->get();

//        $filtered = $vehicles->filter( function($value, $key){
//            return Vehicle::validVin( $value );
//        });

        foreach ($inspections as $ins) {
            $veh = Vehicle::where('work_order',$ins->work_order)->first();

            if( $veh)
            {
                $ins->update(['vehicle_id'=>$veh->id]);
                 //   ->save();
                echo "found for  {$ins->id}\r\n";

            }



        }

        echo "couldn't match up " . Inspection::where('vehicle_id', '=', null )->count();

    }




    public function run()
    {

        $vehicles = Vehicle::where('vin', '!=', '')
            ->pluck('vin', 'id');

//        $filtered = $vehicles->filter( function($value, $key){
//            return Vehicle::validVin( $value );
//        });

        foreach ($vehicles as $id => $vin) {
            if ( Vehicle::validVin( $vin ) === true)
            {
                Inspection::where('vin', '=', $vin)->update(['vehicle_id' => $id]);
                echo "done {$vin}\r\n";
            }
            else
            {
                echo "didn't do {$vin}\r\n";
            }

        }

        echo "couldn't match up " . Inspection::where('vehicle_id', '=', null )->count();

    }


}
