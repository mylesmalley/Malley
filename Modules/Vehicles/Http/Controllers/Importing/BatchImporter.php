<?php

namespace Modules\Vehicles\Http\Controllers\Importing;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use App\Models\Inspection;use Illuminate\Http\Request;
use Illuminate\View\View;
use Ixudra\Curl\Facades\Curl;
use JetBrains\PhpStorm\NoReturn;


class BatchImporter extends Controller
{
    public function test( $start )
    {
        //include( 'App\Programs\Vehicles\Imports\batch01.php');
       $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/aVINs.php');

       for ($i = $start; $i <  min( count( $batch ), 25 ) + $start  ; $i++ )
       {
           $vehicle = Vehicle::updateOrCreate([
               'vin'=> $batch[$i][2]
           ], [
                'malley_number' => $batch[$i][0],
               'customer_name' => $batch[$i][1],
               'user_id' => 3,
           ]);

           // NhTSA API call
           $curl = Curl::to("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/".$vehicle->vin)
               ->withData(['format'=>'json'])
               ->get();
           /** @noinspection PhpComposerExtensionStubsInspection */
           $nhtsa = json_decode($curl);

           //  dd($nhtsa->Results[0]->Make);
           $results = $nhtsa->Results[0];

           // $edmunds = Edmunds::decodeVin( $request->vin );
           $vehicle->make = $results->Make ?? null;
           $vehicle->model = $results->Model ?? null;
           $vehicle->fuel = $results->FuelTypePrimary ?? null;
           $vehicle->drive = $results->DriveType ?? null;
           $vehicle->year = $results->ModelYear ?? date('Y');
           // $vehicle->manufacturer_code = $edmunds['manufacturerCode'] ?? null;
           $vehicle->interior_colour = "Grey";
           $vehicle->exterior_colour = "White";
          // $vehicle->raw_nhtsa_data = json_encode($nhtsa);


           $vehicle->save();

           echo "processed {$i}\n\r";
       }



    }



    public function otherVins( $start )
    {
        //include( 'App\Programs\Vehicles\Imports\batch01.php');
        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/otherVins.php');

        for ($i = $start; $i <  min( count( $batch ), 50 ) + $start  ; $i++ )
        {
            $vehicle = Vehicle::updateOrCreate([
                'vin'=> $batch[$i][2]
            ], [
                'work_order' => $batch[$i][0],
                'customer_name' => $batch[$i][1],
                'user_id' => 3,
            ]);

            // NhTSA API call
            $curl = Curl::to("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/".$vehicle->vin)
                ->withData(['format'=>'json'])
                ->get();
            /** @noinspection PhpComposerExtensionStubsInspection */
            $nhtsa = json_decode($curl);

            //  dd($nhtsa->Results[0]->Make);
            $results = $nhtsa->Results[0];

            // $edmunds = Edmunds::decodeVin( $request->vin );
            $vehicle->make = $results->Make ?? null;
            $vehicle->model = $results->Model ?? null;
            $vehicle->fuel = $results->FuelTypePrimary ?? null;
            $vehicle->drive = $results->DriveType ?? null;
            $vehicle->year = $results->ModelYear ?? date('Y');
            // $vehicle->manufacturer_code = $edmunds['manufacturerCode'] ?? null;
            $vehicle->interior_colour = "Grey";
            $vehicle->exterior_colour = "White";
            // $vehicle->raw_nhtsa_data = json_encode($nhtsa);


            $vehicle->save();

            echo "processed {$i}\n\r";
        }



    }



    public function torque(  )
    {

        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/torque.php');

        for ($i = 0; $i <  count( $batch ) ; $i++ )
        {
            $vehicle = Vehicle::updateOrCreate([
                'vin'=> $batch[$i][0]
            ], [
                'torque_tools_used' => $batch[$i][1],
                'battery_1_serial' => $batch[$i][2],
                'battery_2_serial' => $batch[$i][3],
                'inverter_serial' => $batch[$i][6],
                'amplifier_serial' => $batch[$i][5],
                'siren_date' => $batch[$i][4],
                'user_id' => 3,
            ]);


            echo "processed {$i}\n\r";
        }



    }


    public function ford_fca( $start )
    {
        //include( 'App\Programs\Vehicles\Imports\batch01.php');
        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/ford_fca.php');

        for ($i = $start; $i <  min( count( $batch ), 100 ) + $start  ; $i++ )
        {
            $vehicle = Vehicle::updateOrCreate([
                'vin'=> $batch[$i][0]
            ], [
                'FCA_T24' => $batch[$i][1],
                'FORD_17S15' => $batch[$i][2],
                'Ford_15E05' => $batch[$i][3],
                'FCA_VB2' => $batch[$i][4],
                'FCA_W00' => $batch[$i][5],
                'user_id' => 3,
            ]);


            if ( ! $vehicle->year )
            {


                // NhTSA API call
                $curl = Curl::to("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/".$vehicle->vin)
                    ->withData(['format'=>'json'])
                    ->get();
                /** @noinspection PhpComposerExtensionStubsInspection */
                $nhtsa = json_decode($curl);

                //  dd($nhtsa->Results[0]->Make);
                $results = $nhtsa->Results[0];

                // $edmunds = Edmunds::decodeVin( $request->vin );
                $vehicle->make = substr($results->Make, 0, 20) ?? null;
                $vehicle->model = substr($results->Model,0,20) ?? null;
                $vehicle->fuel = $results->FuelTypePrimary ?? null;
                $vehicle->drive = $results->DriveType ?? null;
                $vehicle->year = $results->ModelYear ?? date('Y');
                // $vehicle->manufacturer_code = $edmunds['manufacturerCode'] ?? null;
                $vehicle->interior_colour = "Grey";
                $vehicle->exterior_colour = "White";
                // $vehicle->raw_nhtsa_data = json_encode($nhtsa);
            }


            $vehicle->save();

            echo "processed {$i}\n\r";
        }



    }








    public function arrival_date(  )
    {
        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/arrival.php');
//
       for ($i = 0; $i <  count( $batch ) ; $i++ )
       {

            $vehicle = Vehicle::where('vin', $batch[$i][0]  )->first();
            if ($vehicle)
            {
                $vehicle->dates()->create([
                    'user_id' => 3,
                    'start' => $batch[$i][1],
                    'end' => $batch[$i][1],
                    'title' => "Arrival Date",
                    'notes' => "imported from VEHICLE INCOMING INSPECTION.xlsx",
                ]);
                echo "imported {$i}";

            }
            else
            {
                echo "failed on  {$i}";

            }

       }



    }








    public function work_orders(  )
    {

        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/work_orders.php');

        for ($i = 0; $i <  count( $batch ) ; $i++ )
        {
            $vehicle = Vehicle::where( 'vin', $batch[$i][0] )->first();
            $vehicle->work_order = $batch[$i][1];
            $vehicle->save();


            echo "processed {$i}\n\r";
        }



    }















    public function lease_dates(  )
    {
        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/lease_dates.php');
//
        for ($i = 0; $i <  count( $batch ) ; $i++ )
        {

            $vehicle = Vehicle::where('vin', $batch[$i][0]  )->first();
            if ($vehicle)
            {
//                if ( $batch[$i][1] )
//                {

//                    $vehicle->dates()->create([
//                        'user_id' => 3,
//                        'start' => $batch[$i][1],
//                        'end' => $batch[$i][1],
//                        'title' => "Delivery Date",
//                        'notes' => "imported from A.xlsx",
//                    ]);
//                }
//
//                if ( $batch[$i][2] )
//                {
//
//                    $vehicle->dates()->create([
//                        'user_id' => 3,
//                        'start' => $batch[$i][2],
//                        'end' => $batch[$i][2],
//                        'title' => "Lease Expiry Date",
//                        'notes' => "imported from A.xlsx",
//                    ]);
//                }

                if ( $batch[$i][2] )
                {

                    $vehicle->dates()->create([
                        'user_id' => 3,
                        'start' => $batch[$i][3],
                        'end' => $batch[$i][3],
                        'title' => "Warranty Expiry Date",
                        'notes' => "imported from A.xlsx",
                    ]);
                }


                echo "imported {$i} \r\n";

            }
            else
            {
                echo "failed on  {$i} \r\n ";

            }

        }



    }









    public function flow(  )
    {

        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/flow.php');

        for ($i = 0; $i <  count( $batch ) ; $i++ )
        {
            $vehicle = Vehicle::where( 'vin', $batch[$i][0] )->first();
            $vehicle->o2_regulator_serial = $batch[$i][1];
            $vehicle->flow_meter_1_serial = $batch[$i][2];
            $vehicle->flow_meter_2_serial = $batch[$i][3];
            $vehicle->flow_meter_3_serial = $batch[$i][4];
            $vehicle->save();

            echo "processed {$i}\n\r";
        }



    }

    public function fire(  )
    {

        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/fire.php');

        for ($i = 0; $i <  count( $batch ) ; $i++ )
        {
            $vehicle = Vehicle::where( 'vin', $batch[$i][0] )->first();
            $vehicle->fast_idle_serial = $batch[$i][2];

            $vehicle->save();

            echo "processed {$i}\n\r";
        }



    }










    public function wa3(  )
    {

        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/wa3.php');

        $batch = array_values( $batch );

        for ($i = 0; $i <  count( $batch ) ; $i++ )
        {
            $wa = \App\Models\Inspection::create( $batch[$i]);

            echo "processed {$i}\n\r";
        }



    }













    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function batch_files(  ): View
    {
        return view('vehicles::batch.incoming' );
    }



    public function store_files( Request $request  )
    {
        $request->validate([
            'upload.*' => 'required|file|mimes:pdf,doc,docx,xls,xlsx,ppt,pptx,zip,png,jpg,jpeg|max:15360',
        ]);

        if($request->hasfile('upload'))
        {
            foreach($request->file('upload') as $upload) {

                $vin = explode( ' ', $upload->getClientOriginalName() );
                $vin = explode( '.', end( $vin ));
                $fragment =  $vin[0];

                $vehicle = Vehicle::where('vin','like', "%$fragment")->first();
                //dd( $vehicle );
                $vehicle->addMedia( $upload )
                    ->usingFilename('tire_information_sticker.jpg')
                    ->usingName('Vin Sticker')
                    ->toMediaCollection('uploads',  's3');

            }
        }

        return redirect()->back();
    }


    public function link_inspections()
    {
        $orphans = Inspection::where('vin','=',null)
            ->get()
            ->pluck('vin');

        $vehicles = Vehicle::whereIn('vin', $orphans )
            ->pluck('vin','id');

        foreach( $vehicles as $id => $vin )
        {
            Inspection::where('vin', '=', $vin)->update(['vehicle_id'=>$id]);
            echo "done {$vin}\r\n";
        }

        $remaining = Inspection::where('vin','=',null)
            ->get()
            ->count();

        echo " Remaining Orphans {$remaining}\r\n";

        return 1;
     //   dd($vehicles);
    }






























    public function ten( $start )
    {

        $records = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/otherVINs.php');

        foreach ( $records as $rec )
        {
            $vehicle = Vehicle::where('vin',$rec['vin'])->first();

            if ( !$vehicle)
            {
                $vehicle = Vehicle::create([
                    'vin' => $rec['vin'],
                 //   'work_order' => $batch[$i][0],
                    'customer_name' => $rec['customer_name'],
                    'customer_number' => $rec['customer_number'],
                    'malley_number' => $rec['malley_number'],
                    'user_id' => 3,
                ]);
                $vehicle->save();

                // NhTSA API call
                $curl = Curl::to("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/".$vehicle->vin)
                    ->withData(['format'=>'json'])
                    ->get();
                /** @noinspection PhpComposerExtensionStubsInspection */
                $nhtsa = json_decode($curl);

                //  dd($nhtsa->Results[0]->Make);
                $results = $nhtsa->Results[0];

                // $edmunds = Edmunds::decodeVin( $request->vin );
                $vehicle->make = substr( $results->Make , 0, 20) ?? null;
                $vehicle->model = substr( $results->Model, 0, 20) ?? null;
                $vehicle->fuel = substr( $results->FuelTypePrimary, 0, 20) ?? null;
                $vehicle->drive = $results->DriveType ?? null;
                $vehicle->year = $results->ModelYear ?? date('Y');
                // $vehicle->manufacturer_code = $edmunds['manufacturerCode'] ?? null;
                $vehicle->interior_colour = "Grey";
                $vehicle->exterior_colour = "White";
                // $vehicle->raw_nhtsa_data = json_encode($nhtsa);


                $vehicle->save();
                echo "Added {$rec['malley_number']}\r\n";
            }
            else
            {
                $vehicle->update([
                    'customer_name' => $rec['customer_name'],
                    'malley_number' => $rec['malley_number'],
                    'customer_number' => $rec['customer_number'],
                ]);
                echo "updated {$rec['malley_number']}\r\n";
            }



        }



    }




    public function eleven(  )
    {
        $batch = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/11.php');
//
        foreach ( $batch as $rec )
        {
            $vehicle = Vehicle::where('vin',$rec['vin'])->first();

            if ($vehicle)
            {


                $dates = collect( $vehicle->dates );

                if ( !$dates->contains('title','Date In Service'))
                {
                    if ( $rec['service'] )
                    {

                        $vehicle->dates()->create([
                            'user_id' => 3,
                            'start' =>  $rec['service'],
                            'end' => $rec['service'],
                            'title' => "Date In Service",
                            'notes' => "",
                        ]);
                    }
               }



                if ( !$dates->contains('title','Next Renewal Date'))
                {
                    if ( $rec['renewal'] )
                    {

                        $vehicle->dates()->create([
                            'user_id' => 3,
                            'start' =>  $rec['renewal'],
                            'end' => $rec['renewal'],
                            'title' => "Next Renewal Date",
                            'notes' => "",
                        ]);
                    }
                }



                 if ( !$dates->contains('title','RBC Payment Date'))
                 {
                     if ( $rec['rbc'] )
                     {

                         $vehicle->dates()->create([
                             'user_id' => 3,
                             'start' =>  $rec['rbc'],
                             'end' => $rec['rbc'],
                             'title' => "RBC Payment Date",
                             'notes' => "",
                         ]);
                     }
                 }




                                  if ( !$dates->contains('title','Sign Off Date'))
                                  {
                                      if ( $rec['sign'] )
                                      {

                                          $vehicle->dates()->create([
                                              'user_id' => 3,
                                              'start' =>  $rec['sign'],
                                              'end' => $rec['sign'],
                                              'title' => "Sign Off Date",
                                              'notes' => "",
                                          ]);
                                      }
                                  }


            }

        }



    }



    public function relink_inspections()
    {

        $vehicles = Vehicle::where('vin', '!=','' )
            ->pluck('vin','id');

        foreach( $vehicles as $id => $vin )
        {
            Inspection::where('vin', '=', $vin)->update(['vehicle_id'=>$id]);
            echo "done {$vin}\r\n";

        }
//
//        $remaining = Inspection::where('vin','=',null)
//            ->get()
//            ->count();

//        echo " Remaining Orphans {$remaining}\r\n";

        return 1;
        //   dd($vehicles);
    }







    #[NoReturn] public function thirteen(  )
    {

        $records = include('/var/www/OptionMaker/app/Programs/Vehicles/Imports/13.php');
        echo "total found so far ".count($records)." \r\n";
        $missing = [];
        $found = 0;
        foreach ( $records as $rec )
        {
            $vehicle = Vehicle::where('vin',$rec['vin'])->first();

            if ( $vehicle)
            {
                $found += 1;
            }
            else
            {
                $missing[] = $rec['vin'];
                $vehicle = Vehicle::create([
                    'vin' => $rec['vin'],
                    //   'work_order' => $batch[$i][0],
//                    'customer_name' => $rec['customer_name'],
//                    'customer_number' => $rec['customer_number'],
//                    'malley_number' => $rec['malley_number'],
                    'user_id' => 3,
                ]);
                $vehicle->save();

                // NhTSA API call
                $curl = Curl::to("https://vpic.nhtsa.dot.gov/api/vehicles/DecodeVinValuesExtended/".$vehicle->vin)
                    ->withData(['format'=>'json'])
                    ->get();
                /** @noinspection PhpComposerExtensionStubsInspection */
                $nhtsa = json_decode($curl);

                //  dd($nhtsa->Results[0]->Make);
                $results = $nhtsa->Results[0];

                // $edmunds = Edmunds::decodeVin( $request->vin );
                $vehicle->make = substr( $results->Make , 0, 20) ?? null;
                $vehicle->model = substr( $results->Model, 0, 20) ?? null;
                $vehicle->fuel = substr( $results->FuelTypePrimary, 0, 20) ?? null;
                $vehicle->drive = $results->DriveType ?? null;
                $vehicle->year = $results->ModelYear ?? date('Y');
                // $vehicle->manufacturer_code = $edmunds['manufacturerCode'] ?? null;
             //   $vehicle->interior_colour = "Grey";
            //    $vehicle->exterior_colour = "White";
                // $vehicle->raw_nhtsa_data = json_encode($nhtsa);

                $vehicle->save();
            }



        }

        echo "found {$found} \r\n";
        dd( $missing );

    }




}
