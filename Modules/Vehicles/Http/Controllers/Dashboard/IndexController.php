<?php

namespace Modules\Vehicles\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use App\Models\WarrantyClaim;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;use Carbon\Carbon;
use Carbon\CarbonPeriod;
/**
 * Class InspectionController
 * @package App\Programs\Vehicles\Controllers
 */
class IndexController extends Controller
{
    /**
     * @return View
     */
    public function show(): View
    {

        return view('vehicles::dashboard.index',[
            'labels' => $this->inspectionSeverity()['labels'],
            'data' => $this->inspectionSeverity()['data'],

            'recentInspectionsLabels' => $this->recentInspectionSources()['labels'],
            'recentInspectionssData' => $this->recentInspectionSources()['data'],

            'warrantyLabels' => $this->warranty()['labels'],
            'warrantyData' => $this->warranty()['data'],
        ]);
    }



    public function inspectionSeverity(): array
    {
        $start = Carbon::create('2015-03-01');
        $months = CarbonPeriod::create('2015-03-01', '1 month', 'today');
        $buckets = [];

        $labels = [];

        foreach ($months as $key => $date) {
            $buckets[] = ["LOW"=>0,"MEDIUM"=>0,"HIGH"=>0, "N / A"=>0 ]; //[$date->format('Y-m'), $start->diffInMonths( $date )];
            $labels[] = $date->format('M Y');
        }

        $inspections = DB::table('inspections')->where('date_entered','!=',null)->get();


        $inspections->each( function($item) use($start, &$buckets, &$output) {

            $month = $start->diffInMonths( Carbon::parse($item->date_entered) );
            if (array_key_exists( $item->severity, $buckets[ $month ]) )
            {
                $buckets[ $month ][ $item->severity ] ++;

            }


        });

        $set = [
            [
                'data' => [],
                'label' => "High",
                "borderColor"=> "#ce494a",
                "fill" => false,
            ],
            [
                'data' => [],
                'label' => "Medium",
                "borderColor"=> "#e9af41",
                "fill" => false,
            ],
            [
                'data' => [],
                'label' => "Low",
                "borderColor"=> "#6689c3",
                "fill" => false,
            ],
            [
                'data' => [],
                'label' => "NA",
                "borderColor"=> "#47a569",
                "fill" => false,
            ],        ];
        foreach( $buckets as $bucket)
        {

            $set[0]['data'][] = $bucket["HIGH"];
            $set[1]['data'][] = $bucket["MEDIUM"];
            $set[2]['data'][] = $bucket["LOW"];
            $set[3]['data'][] = $bucket["N / A"];

        }

        return [
            'labels' => json_encode($labels),
            'data' => json_encode( $set ),

        ];

    }




    public function recentInspectionSources(): array
    {
        $query = Inspection::selectRaw("type, COUNT(id) AS qty")
            ->whereRaw('date_entered >= GETDATE()-90')
            ->groupBy('type')
            ->orderBy('qty','DESC')
            ->get();

        $data = $query->pluck('qty')->map(function( $item ){
            return (int) $item;
        });

        $set = [
            [
                'data' => $data->toArray(),
                "backgroundColor" => [
                    "#cd3b24",
                    "#3e618b",
                    "#f7f6e4",
                    "#edcb2b",
                    "#88603d",
                    "#05836d",
                    "#f99372",
                    "#99cccc",
                    "#c3bc12",
                    "#397fa2",
                    "#99488b",
                    "#efcae7",
                    "#cde3f4",
                    "#ffe990"
                ]
            ],
        ];

        return [

            'labels' => json_encode($query->pluck('type')),
            'data' => json_encode($set )
        ];

    }





    public function warranty(): array
    {
        $query = WarrantyClaim::selectRaw("vehicles.model AS model, COUNT(warranty_claims.id) qty")
            ->leftJoin('vehicles','vehicles.id','=','warranty_claims.vehicle_id')
            ->whereRaw('warranty_claims.created_at >= GETDATE()-365')
            ->groupBy('vehicles.model')
        //    ->orderBy('qty','DESC')
            ->get();

        $data = $query->pluck('qty')->map(function( $item ){
            return (int) $item;
        });

        $set = [
            [
                'data' => $data->toArray(),
                "backgroundColor" => [
                    "#cd3b24",
                    "#3e618b",
                    "#f7f6e4",
                    "#edcb2b",
                    "#88603d",
                    "#05836d",
                    "#f99372",
                    "#99cccc",
                    "#c3bc12",
                    "#397fa2",
                    "#99488b",
                    "#efcae7",
                    "#cde3f4",
                    "#ffe990"
                ]
            ],
        ];

        return [

            'labels' => json_encode($query->pluck('model')),
            'data' => json_encode($set )
        ];

    }



}
