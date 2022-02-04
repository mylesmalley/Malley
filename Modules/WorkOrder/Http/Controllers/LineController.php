<?php

namespace Modules\WorkOrder\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\WorkOrderLine;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


/**
 * Class LineController
 * @package Modules\WorkOrder\Http\Controllers
 */
class LineController extends Controller
{

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request ): RedirectResponse
    {
        $request->validate([
           "quantity" => "nullable|required_without_all:part_number,description|numeric",
           "part_number" => "nullable|required_without_all:quantity,description|string|max:30",
           "description" => "nullable|required_without_all:quantity,part_number|string",
            "work_order_id" => "required|int",
            'order' => "required|int"
        ]);

        DB::table('work_order_lines')
                 ->where('work_order_id', $request->work_order_id )
                ->where('order','>=', $request->order)
                ->increment('order');

        WorkOrderLine::create($request->only([
            'quantity',
            'part_number',
            'description',
            'work_order_id',
            'order',
        ]));

        return redirect( "/workOrders/{$request->work_order_id}/lines" );
    }


    /**
     * @param Request $request
     * @param WorkOrderLine $line
     * @return RedirectResponse
     */
    public function update( Request $request, WorkOrderLine $line ): RedirectResponse
    {
        $request->validate([
            "quantity" => "nullable|required_without_all:part_number,description|int",
            "part_number" => "nullable|required_without_all:quantity,description|string|max:30",
            "description" => "nullable|required_without_all:quantity,part_number|string",
        ]);

         $line->update($request->only(['quantity','part_number','description']));
         $line->save();

        return redirect( "/workOrders/{$line->work_order->id}/lines" );
    }


    /**
     * reorders lines after this one and then delets target
     *
     * @param WorkOrderLine $line
     * @return RedirectResponse
     * @throws \Exception
     */
    public function destroy( WorkOrderLine $line ): RedirectResponse
    {
        DB::table('work_order_lines')
            ->where('work_order_id', $line->work_order_id )
            ->where('order','>=', $line->order)
            ->decrement('order');

        $id = $line->work_order_id;
        $line->delete();

        return redirect( "/workOrders/{$id}/lines" );
    }


}
