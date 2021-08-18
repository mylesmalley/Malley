<?php

namespace Modules\Vehicles\Http\Controllers\InspectionReports;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class InspectionReportController extends Controller
{

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function inspectionReportForm( Request $request )
    {

     //   dd(( $request->path() ));

        $results = [];

        if ($request->has(['start_date', 'end_date', 'order', 'column'])) {

            $request->validate([
                'start_date' => 'sometimes|date',
                'end_date' => 'sometimes|date',
                'order' => [
                    'sometimes',
                    Rule::in(['asc', 'desc']),
                ],
                'column' => [
                    'sometimes',
                    Rule::in(['type', 'severity', 'source', 'location', 'date_entered']),
                ],
            ]);

            $results = Inspection::with('vehicle')
                ->whereDate('date_entered', '>=', $request->input('start_date'))
                ->whereDate('date_entered', '<=', $request->input('end_date'))
                ->orderBy($request->input('column'),
                    $request->input('order'))
                ->get();

        }
        else
        {
            return redirect("/vehicles/inspections?start_date=".date('Y-m-d', strtotime('last month'))."&end_date=".date('Y-m-d', strtotime('today'))."&column=date_entered&order=asc");
//                                /vehicles/inspections?start_date=2021-05-15&end_date=2021-06-15&column=date_entered&order=asc
//                                /vehicles/inspections?start_date=2021-06-08&end_date=2021-05-15&column=date_entered&order=asc
        }



        $locationSummmary = [];
        $severitySummary = [];
        $sourcesSummary = [];
        $typesSummary = [];

        foreach (Inspection::locations() as $loc) {
            $locationSummmary[$loc] = 0;
        }
        foreach (Inspection::types() as $loc) {
            $typesSummary[$loc] = 0;
        }
        foreach (Inspection::sources() as $loc) {
            $sourcesSummary[$loc] = 0;
        }
        foreach (['LOW','MEDIUM','HIGH','N/A'] as $loc) {
            $severitySummary[$loc] = 0;
        }

        foreach ($results as $r)
        {
            $locationSummmary[ $r->location ] += 1;
            $typesSummary[ $r->type ] += 1;
            $sourcesSummary[ $r->source ] += 1;
            $severitySummary[ $r->severity ] += 1;
        }


        return View::make('vehicles::inspections.inspectionReportForm', [
            'results' => $results,
            'locationSummmary' => $locationSummmary,
            'typesSummary' =>   $typesSummary,
            'sourcesSummary' => $sourcesSummary,
            'severitySummary' => $severitySummary,
        ]);
    }




    public function focusedReport( Request $request )
    {

        $results = [];

        if ($request->has(['start_date', 'end_date', 'order', 'column','focus_column', 'focus_value'])) {

            $request->validate([
                'start_date' => 'sometimes|date',
                'end_date' => 'sometimes|date',
                'order' => [
                    'sometimes',
                    Rule::in(['asc', 'desc']),
                ],
                'column' => [
                    'sometimes',
                    Rule::in(['type', 'severity', 'source', 'location', 'date_entered']),
                ],
                'focus_column' => [
                    'sometimes',
                    Rule::in(['type', 'severity', 'source', 'location', 'date_entered']),
                ],
                'focus_value' => [
                    'required',
                    'string'
                ]
            ]);

            $results = Inspection::with('vehicle')
                ->whereDate('date_entered', '>=', $request->input('start_date'))
                ->whereDate('date_entered', '<=', $request->input('end_date'))
                ->where($request->input('focus_column'), $request->input('focus_value') )
                ->orderBy($request->input('column'),
                    $request->input('order'))
                ->get();

        }
        else
        {
            return redirect("/vehicles/inspections?start_date=".date('Y-m-d', strtotime('last month'))."&end_date=".date('Y-m-d', strtotime('today'))."&column=date_entered&order=asc");
        }



        return View::make('vehicles::inspections.inspectionFocused', [
            'results' => $results,

        ]);
    }
}
