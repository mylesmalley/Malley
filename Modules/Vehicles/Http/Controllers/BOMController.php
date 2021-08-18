<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;
/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class BOMController extends Controller
{
    /**
     * @param Vehicle $vehicle
     * @return View
     */
    public function show(Vehicle $vehicle): View
    {
        $bom = $this->get( $vehicle->firstWorkOrder() );


        return view('vehicles::bom.show', [
                'vehicle' => $vehicle,
                'bom' => $bom,
            ]);
    }


    /**
     * @param string $work_order
     * @return \Illuminate\Support\Collection
     */
    public function get( string $work_order )
    {
       return DB::connection('syspro')
            ->table('WipJobAllMat')
            ->select('StockCode', 'StockDescription', 'QtyIssued','Uom')
            ->where('Job',$work_order )
            ->where('QtyIssued','>',0)
            ->get();
    }


//    public function get( string $work_order )
//    {
//        return DB::connection('syspro')
//            ->table('WipJobAllMat')
//            ->select(DB::raw("StockCode, StockDescription, Uom, UnitQtyReqd - QtyIssued AS Remaining" ))
//            ->where('Job',$work_order )
//           // ->where('Remaining','>',0)
//            ->get();
//    }
// SELECT WJ.StockCode, WJ.StockDescription, (WM.QtyToMake*WJ.UnitQtyReqd) AS [UnitQtyRed] FROM WipJobAllMat AS WJ, WipMaster AS WM WHERE WJ.Job = WM.Job AND WJ.Job = 'A0001233'

}
