<?php

namespace Modules\Index\Http\Controllers\Component;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Component;
use \Illuminate\Http\RedirectResponse;

class ImportPhantomController extends Controller
{

    /**
     * takes a phantom and an option id and imports the components associated.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function import( Request $request ): RedirectResponse
    {
        $request->validate([
            'option_id' => 'required|numeric',
            'phantom' => "required|string|exists:syspro.BomStructure,ParentPart",
        ]);


        // delete any existing components
        DB::table('components')
            ->where('component_part_category','!=','N')
            ->where('option_id', $request->input('option_id'))
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
            $component = new Component([
                'option_id'                 =>  $request->input('option_id'),
                'component_sub_assembly'    =>  'MF1',
                'component_stock_code'      =>  trim( $sys->Component ),
                'component_description'     =>  trim( $sys->Description ),
                'component_long_description'=>  trim( $sys->LongDesc ),
                'component_part_category'   => trim( $sys->PartCategory ),
                'component_material_qty'    => (float) trim( $sys->QtyPer ),
                'component_material_cost'   => (float) $sys->MaterialCost,
                'component_unit_of_measure' => trim( $sys->CostUom ),
                'component_revision'       => 0,
                'component_item_code'       => '',
                'component_where_built_location' => '',
                'component_install_area'    => '',
                'component_notes'           => '',
            ]);

            $component->save();
        }

        // return back
        return back()->with('success','Imported Components.');

    }

}


