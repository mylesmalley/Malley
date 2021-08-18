<?php

namespace Modules\Index\Http\Controllers\Component;

use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Component;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\RedirectResponse;

class ComponentController extends Controller
{
    /**
     * @param Option $option
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Option $option, Request $request): RedirectResponse
    {
        $request->validate([
            'stock_code' => ['required',
                'string',
                'exists:syspro.InvMaster,StockCode',
                function ($attribute, $value, $fail) use ($option) {
                    $count = Component::where('option_id', $option->id)
                        ->where('component_stock_code', $value)
                        ->count();

                    if ($count > 0) {
                        $fail('Stock codes can only be used once in a BOM');
                    }
                },
            ],
            'quantity' => 'required|numeric',
            'option_id' => 'required',
        ]);

        $c = new Component();

        $part = DB::connection('syspro')
                    ->table('InvMaster')
                    ->where('StockCode', $request->stock_code)
                    ->first();

        $c->option_id = $option->id;
        $c->component_material_qty = $request->quantity;
        $c->component_material_cost = (float)$part->MaterialCost ;

        $c->component_unit_of_measure = $part->StockUom;
        $c->component_price_category = $part->PriceCategory;
        $c->component_stock_code = $request->stock_code;
        $c->component_description = $part->Description;
        $c->component_part_category = $part->PartCategory;



        $c->save();

        return redirect()->back();



    }


    /**
     * @param Option $option
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete( Option $option, Request $request ): RedirectResponse
    {
        DB::table('components')
            ->where([
                'option_id' => $option->id,
                'id' => $request->component_id
            ])->delete();
        return redirect()->back();
    }
}
