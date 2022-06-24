<?php

namespace Modules\BodyguardBOM\Http\Controllers\Kits;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\BodyguardBOM\Models\Kit;
use Modules\BodyguardBOM\Models\SysproStockCode;
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
            ->toArray() ;

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


        SysproStockCode::create([
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
            SysproStockCode::where('id', '=', $request->input('id'))
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
     * deletes the locally staged stock codes
     *
     * @param Kit $kit
     * @return RedirectResponse
     */
    public function clear_local_stock_codes( Kit $kit ): RedirectResponse
    {
        SysproStockCode::where('bg_kit_id', '=', $kit->id )
            ->delete();

        return redirect()
            ->back();
    }


    /**
     * clear out the stored components in syspro and replace with the local store
     *
     * @param Kit $kit
     * @return RedirectResponse
     */
    public function sync_local_components_to_syspro(  Kit $kit  )
    {
        $kit->clear_components_from_syspro_phantom();
        $kit->push_components_to_syspro();

        return redirect()
            ->back();
    }


    /**
     * accepts a known existing phantom and copies it's contents to this oen.
     *
     * @param Kit $kit
     * @param Request $request
     * @return RedirectResponse
     */
    public function import_components_from_syspro_phantom( Kit $kit, Request $request ): RedirectResponse
    {
        $request->validate([
            'phantom' => "required|string|exists:syspro.BomStructure,ParentPart",
        ]);

        // delete any existing components
        SysproStockCode::where('bg_kit_id', '=', $kit->id )
            ->delete();

        // get the components from syspro
        $syspro = DB::connection('syspro')
            ->table('BomStructure')
            ->where('ParentPart', $request->input('phantom') )
            ->leftJoin('InvMaster', 'BomStructure.Component', '=', 'InvMaster.StockCode')
            ->get();

        // redirect back if no results found
        if (!$syspro->count() ) return back()->with('error','Valid but empty phantom.');


        // loop through the components and add them each to the option
        foreach($syspro as $sys)
        {
            SysproStockCode::create([
                'bg_kit_id' => $kit->id,
                'stock_code' => $sys->Component,
                'quantity' => $sys->QtyPer,
            ]);
        }

        // return back
        return back()
            ->with('success','Imported Components.');

    }




}


