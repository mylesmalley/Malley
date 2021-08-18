<?php

namespace Modules\WorkOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkOrder;


/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class TestController extends Controller
{
    public function test()
    {
        $lines = WorkOrder::find(1)->lines;

        return view('workorder::test', ['lines'=>$lines]);
    }
}
