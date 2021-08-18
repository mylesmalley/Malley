<?php

namespace Modules\Vehicles\Http\Controllers\Documents;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Mpdf\Mpdf;
use View;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class PDIController extends Controller
{
    public function transit( Vehicle $vehicle )
    {
        $d = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $d->writeHTML( View::make('vehicles::documents.pdi.cover', [
            'vehicle'=>$vehicle
        ])
        );

        $d->addPage();

        $d->writeHTML( View::make('vehicles::documents.pdi.transit', [
                'vehicle'=>$vehicle
            ])
        );


        $d->output();
    }

    public function promaster( Vehicle $vehicle )
    {
        $d = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $d->writeHTML( View::make('vehicles::documents.pdi.cover', [
            'vehicle'=>$vehicle
        ])
        );

        $d->addPage();

        $d->writeHTML( View::make('vehicles::documents.pdi.promaster', [
            'vehicle'=>$vehicle
        ])
        );


        $d->output();
    }

}
