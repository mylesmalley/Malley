<?php

namespace Modules\Vehicles\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Shows a simple form and results if they exist
     *
     * @param Request $request
     * @return View
     */
    public function search( Request $request ): View
    {
        $request->validate([
            'target' => "sometimes|string",
            'term' => 'sometimes|string|min:3',
        ]);

        // only run the search if the term and target are actually supplied and validated
        $results = collect([]);
        if ( $request->target && $request->term )
        {
            $results = $this->lookup( $request->target, $request->term );
        }


        return view('vehicles::search', [
            'title'   => "Search",
            'request' => $request,
            'results' => $results,
        ]);
    }


    /**
     * Parses the terms sent form the form into database requests and returns them
     *
     * @param string $target
     * @param string $term
     * @return Collection
     */
    private function lookup( string $target, string $term ): Collection
    {
        $query = DB::table('vehicles');

        switch ( $target )
        {
            case "work_order":
                $term = strtoupper($term);
                $query->where('work_order', 'like', "%{$term}%");
                break;

            case "customer_name":

                $query->whereRaw('customer_name collate SQL_Latin1_General_CP1_CI_AS LIKE  ?', ["%".$term."%"]);
         //       $query->where('customer_name', 'like', "%{$term}%");
                break;

            case "dealer":
                $query->select(['vehicles.id as id','vin','companies.name as name', 'customer_name', 'make', 'model', 'year', 'malley_number', 'work_order']);
                $query->leftJoin('companies', 'companies.id', '=', 'vehicles.company_id');
                $query->whereRaw('companies.name  collate SQL_Latin1_General_CP1_CI_AS LIKE  ?', ["%".$term."%"]);
                break;


            case "vin":
                $term = strtoupper($term);
                $query->where('vin', 'like', "%{$term}%");
                break;

            case "malley_number":
                $term = strtoupper($term);
                $query->where('malley_number', 'like', "%{$term}%");
                break;

            case "customer_number":
                $term = strtoupper($term);
                $query->where('customer_number', 'like', "%{$term}%");
                break;

            case "flowmeter":
                $term = strtoupper($term);
                $query->where('flow_meter_1_serial', 'like', "%{$term}%")
                    ->orWhere('flow_meter_2_serial', 'like', "%{$term}%")
                    ->orWhere('flow_meter_2_serial', 'like', "%{$term}%");
                break;


            case "qstraint":
                $term = strtoupper($term);
                $query->where('qstraint_serial_1', 'like', "%{$term}%")
                    ->orWhere('qstraint_serial_2', 'like', "%{$term}%")
                    ->orWhere('qstraint_serial_3', 'like', "%{$term}%")
                    ->orWhere('qstraint_serial_4', 'like', "%{$term}%");
                break;

            default:
                $query->where('vin', '=',"xxxxx");
                break;
        }



        return $query//->limit(25)
                ->get();
    }

}
