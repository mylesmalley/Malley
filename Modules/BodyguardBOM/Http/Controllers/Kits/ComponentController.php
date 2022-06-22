<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\BodyguardBOM\Models\Kit;
use Modules\BodyguardBOM\Models\Component;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ComponentController extends Controller
{

    /**
     * @param Kit $kit
     * @return Response
     */
    public function show( Kit $kit ) : Response
    {

        $local_staged_stock_codes = $kit->components()->get();

        $local_codes = $local_staged_stock_codes->pluck('stock_code');

        $syspro_components = DB::connection('syspro')
            ->table('BomStructure')
            ->select(['BomStructure.Component', 'BomStructure.QtyPer', 'InvMaster.Description', 'InvMaster.StockUom' ])
            ->leftJoin('InvMaster', 'BomStructure.Component', '=', "InvMaster.StockCode")
            ->where('ParentPart', $kit->part_number )
            ->get();

        $syspro_records_for_local_components = DB::connection('syspro')
            ->table('InvMaster')
            ->select(['StockCode', 'Description', 'StockUom' ])
            ->whereIn('StockCode', $local_codes )
            ->get()
            ->keyBy('StockCode')
            ->toArray()
        ;

       // dd($local_staged_stock_codes, $local_codes,  $syspro_records_for_local_components);
        $local_components = [];

        foreach( $local_staged_stock_codes as $stock )
        {

            $local_components[] = [
                'id' => $stock->id,
                'stock_code' =>   $stock->stock_code,
                'description' => $syspro_records_for_local_components[ $stock->stock_code ]->Description,
                'quantity' => $stock->quantity,
                'uom' => $syspro_records_for_local_components[ $stock->stock_code ]->StockUom,
            ];

        }


        return response()->view('bodyguardbom::kits.components', [
            'kit' => $kit,
            'syspro_components' => $syspro_components,
            'local_components' => json_decode( json_encode($local_components) )
        ]);
    }


    /**
     * @param Kit $kit
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Kit $kit, Request $request ): RedirectResponse
    {
        $request->validate([
            'stock_code' => 'required|exists:syspro.InvMaster,StockCode|string',
            'quantity' => 'required|numeric',
        ]);


        Component::create([
            'bg_kit_id' => $kit->id,
            'stock_code' => $request->input('stock_code'),
            'quantity' => $request->input('quantity'),
        ]);


        return redirect()->back();
    }


    /**
     * @param Kit $kit
     * @param Request $request
     * @return RedirectResponse
     */
    public function delete(  Kit $kit, Request $request ) : RedirectResponse
    {
        $request->validate([
            'id' => 'required|integer',
        ]);

        try {
            Component::where('id', '=', $request->input('id'))
                ->delete();
        } catch ( Exception $e )
        {
            Log::warning($e);
        }

        Log::info("Deleted component {$request->input('id')} from kit $kit->part_number");

        return redirect()
            ->back();
    }


    /**
     * @param Kit $kit
     * @return RedirectResponse
     */
    public function clear_local_stock_codes( Kit $kit ): RedirectResponse
    {
        Component::where('bg_kit_id', '=', $kit->id )
            ->delete();

        return redirect()
            ->back();
    }


}


