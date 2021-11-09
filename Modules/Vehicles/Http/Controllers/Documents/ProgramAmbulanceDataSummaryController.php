<?php

namespace Modules\Vehicles\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;
use \Mpdf\Mpdf;
use View;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class ProgramAmbulanceDataSummaryController extends Controller
{
    public function show( Vehicle $vehicle )
    {
        $d = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $d->writeHTML( View::make('vehicles::documents.programAmbulanceDataSummary', [
            'vehicle'=>$vehicle
            ])
        );


        $d->output();
    }


    /**
     * @param Vehicle $vehicle
     */
    public function edit( Vehicle $vehicle )
    {
        return view('vehicles::documents.programAmbulanceDataSummaryForm', [
            'vehicle' => $vehicle,
        ]);
    }


    public function update( Request $request, Vehicle $vehicle )
    {
       $request->validate([
       //    "customer_number" => "required|numeric",
           "finance_invoice_number" => "required|string",
          "finance_pretax_invoice_value" => "required|numeric",
          "finance_invoice_total_tax" => "required|numeric",
         // "date_in_service" => "required|date",
        //  "date_lease_expired" => "required|date",
          "finance_lease_number" => "required|string",
          "finance_monthly_lease_pretax" => "required|numeric",
          "finance_monthly_lease_tax" => "required|numeric",
          "refurb_number" => "required|string",
           "malley_number" => "required|string"
       ]);

       $vehicle->update( $request->only([
           "customer_number",
           "finance_invoice_number",
           "finance_pretax_invoice_value",
           "finance_invoice_total_tax",
       //    "date_in_service",
     //      "date_lease_expired",
           "finance_lease_number",
           "finance_monthly_lease_pretax" ,
           "finance_monthly_lease_tax" ,
           "refurb_number" ,
           "malley_number",
       ]));

       $vehicle->save();

       return redirect('/vehicles/'.$vehicle->id.'/documents/ProgramAmbulanceDataSummary');
    }
}
