<?php

namespace Modules\Index\Http\Controllers;
use App\Models\Option;
use App\Models\Component;

use Illuminate\Http\Request;
use App\Http\Requests\ComponentRequest;

use Illuminate\Support\Facades\DB;

class ComponentController extends Controller
{


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( Option $option )
    {
        return view('index::components.create',['option'=>$option, 'component' => Component::class ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ComponentRequest $request)
    {
        $component = new Component( $request->all() );
        $component->save();
        return redirect( 'option/'.$request->option_id );
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit( Component $component )
    {
        $option = $component->option;
        //dd($option);
        return view('index::components.edit',['option'=>$option, 'component' => $component ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ComponentRequest $request, Component $component)
    {
        $component->update($request->all() );
        return redirect('option/'.$component->option_id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Component $component )
    {
        $component->delete();
        return redirect('option/'.$component->option_id);
    }


    public function search( Request $request )
    {
        $query  = strtoupper( $request->term ) ?? 'MI-PAM1112' ;
        $components = DB::connection('syspro')
            ->table('InvMaster')
            ->select(['StockCode','PriceCategory','Description','LongDesc','LabourCost','PartCategory','StockUom','MaterialCost'])
            ->where('StockCode','like','%'.$query.'%')
            ->limit(10)
            ->get();
        $syspro = $components->toArray();


    $nonStock = DB::table('components')->select(
        ['component_stock_code as StockCode',
        'component_description as Description',
        'component_long_description as LongDesc',
	        'component_part_category AS PartCategory',
	        'component_price_category AS PriceCategory',
        'component_unit_of_measure AS StockUom',
        'component_material_cost AS MaterialCost'   ])->where('component_part_category',"N")
            ->where('component_stock_code','like','%'.$query.'%')
        ->get();
    $nonStock = $nonStock->toArray();

    $unique = [];

    foreach ($nonStock as $ns)
    {
        if ( !array_key_exists($ns->StockCode, $unique) )
        {
            $unique[ $ns->StockCode] = $ns ;
        }
    }

    $unique = array_values($unique);

    return json_encode( array_merge( $unique, $syspro ) );

  //  return json_encode( $syspro );

}

}
