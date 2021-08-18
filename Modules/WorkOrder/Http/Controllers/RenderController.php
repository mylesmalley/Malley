<?php

namespace Modules\WorkOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;
use Illuminate\Support\Facades\View;
use Mpdf\Mpdf;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class RenderController extends Controller
{
    public function show( WorkOrder $workOrder )
    {
        $d = new Mpdf([
            'tempDir' => storage_path('tmp'),
        ]);

        $d->writeHTML( View::make('workorder::render', [
                'workOrder'=>$workOrder
            ])
        );


        $d->output();
    }

}
