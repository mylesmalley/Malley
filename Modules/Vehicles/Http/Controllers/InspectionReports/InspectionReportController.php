<?php

namespace Modules\Vehicles\Http\Controllers\InspectionReports;

use App\Http\Controllers\Controller;
use App\Models\Inspection;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\View;
use Illuminate\Validation\Rule;

/**
 * Class VehiclesSerialsController
 * @package App\Programs\Vehicles\Controllers
 */
class InspectionReportController extends Controller
{

    public Collection $results ;
    public array $locationSummary = [];
    public array $severitySummary = [];
    public array $sourcesSummary = [];
    public array $typesSummary = [];


    /**
     * @param Request $request
     * @return bool
     */
    public function setUp(  Request $request  ): bool
    {
        if ($request->has(['start_date', 'end_date', 'order', 'column']))
        {
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

            $this->results = Inspection::with('vehicle')
                ->whereDate('date_entered', '>=', $request->input('start_date'))
                ->whereDate('date_entered', '<=', $request->input('end_date'))
                ->orderBy($request->input('column'),
                    $request->input('order'))
                ->get();


            foreach (Inspection::locations() as $loc) {
                $this->locationSummary[$loc] = 0;
            }
            foreach (Inspection::types() as $loc) {
                $this->typesSummary[$loc] = 0;
            }
            foreach (Inspection::sources() as $loc) {
                $this->sourcesSummary[$loc] = 0;
            }
            foreach (['LOW','MEDIUM','HIGH','N/A'] as $loc) {
                $this->severitySummary[$loc] = 0;
            }


            foreach ($this->results as $r)
            {
                $this->locationSummary[ $r->location ] += 1;
                $this->typesSummary[ $r->type ] += 1;
                $this->sourcesSummary[ $r->source ] += 1;
                $this->severitySummary[ $r->severity ] += 1;
            }


            return true;
        }

        return false;

    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|Redirector|RedirectResponse|Application
     */
    public function inspectionReportForm( Request $request ): \Illuminate\Contracts\View\View|Redirector|RedirectResponse|Application
    {

        if (!$this->setUp( $request) ) {
            return redirect("/vehicles/inspections?start_date=".date('Y-m-d',
                    strtotime('last month'))."&end_date="
                .date('Y-m-d', strtotime('today'))
                ."&column=date_entered&order=asc");
        }

        return View::make('vehicles::inspections.inspectionReportForm', [
            'results' => $this->results,
            'locationSummary' => $this->locationSummary,
            'typesSummary' =>   $this->typesSummary,
            'sourcesSummary' => $this->sourcesSummary,
            'severitySummary' => $this->severitySummary,
        ]);
    }


    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|Redirector|Application|RedirectResponse
     */
    public function fullPageGraphs( Request $request ): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|Redirector|Application|RedirectResponse
    {
        if (!$this->setUp( $request) ) {
            return redirect("/vehicles/inspections?start_date=".date('Y-m-d',
                    strtotime('last month'))."&end_date="
                .date('Y-m-d', strtotime('today'))
                ."&column=date_entered&order=asc");
        }

        return view('vehicles::inspections.fullPageGraphs',[
            'results' => $this->results,
            'locationSummary' => $this->locationSummary,
            'typesSummary' =>   $this->typesSummary,
            'sourcesSummary' => $this->sourcesSummary,
            'severitySummary' => $this->severitySummary,
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
