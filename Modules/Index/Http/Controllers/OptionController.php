<?php

namespace Modules\Index\Http\Controllers;

use App\Models\Option;
use App\Models\BaseVan;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Requests\OptionRequest;
use \Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use App\Models\Component;


class OptionController extends Controller
{
	private $showBlueprintOptions;

    /**
     * OptionController constructor.
     * @param Request $request
     */
	public function __construct(Request $request)
	{
		$this->showBlueprintOptions = $request->query('blueprint') ?? 0;
	}


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function index( Request $request ): RedirectResponse
    {
	    $request->session()->forget( ['bugreport_related_id', 'bugreport_replated_table'] ) ;

	    return redirect('basevan');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param BaseVan $baseVan
     * @return View
     */
    public function create( BaseVan $baseVan ): View
    {
    	//dd ( Option::class );
        return view('index::options.create', ['option'=>null, 'van'=> $baseVan ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param OptionRequest $request
     * @return RedirectResponse
     */
    public function store(OptionRequest $request): RedirectResponse
    {
        $option = new Option( $request->all() );
        $option->option_name = strtoupper( $request->namePrefix . '-' . $request->nameIdentifier . '-' . $request->nameRevision );


        $option->save();
        return redirect('option/'.$option->id );
    }



    /**
     * Display the specified resource.
     *
     * @param Option $option
     * @return View
     */
    public function show(Option $option): View
    {

	    session( ['bugreport_related_id' => $option->id ,
		    'bugreport_related_table' => 'options'
	    ] );


	    $option->with('components', 'templates', 'formElementItems','formElementItems.formElement','formElementItems.formElement.form');


        return view('index::options.show',['option'=> $option ]);
    }

    /**
     * Show the form for editing the specified resource.
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Option $option)
    {

        return view('index::options.create', ['option'=>$option, 'van'=> $option->base_van ] );
    }



    /**
     * Update the specified resource in storage.
     * @param OptionRequest $request
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(OptionRequest $request, Option $option)
    {

	    $option->update( $request->all() );
	    $option->option_name = strtoupper( $request->namePrefix . '-' . $request->nameIdentifier . '-' . $request->nameRevision );
        $option->save();

        return redirect('option/'.$option->id );
    }



    /**
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function compareIndexToSyspro( Option $option )
    {
        $list = $option->uniqueMergedComponents();
        $index = $option->indexComponents();
        $syspro = $option->sysproComponents();

        $output = [];

        foreach ($list as $item)
        {
            $class = 'success';

            $indexValue = (isset($index[$item])) ? $index[$item] : "Missing";
            $sysproValue = (isset($syspro[$item])) ? $syspro[$item] : "Missing";

            if ($indexValue !== $sysproValue) $class = 'danger';

            $output[] = [
                "index"  =>  $indexValue,
                "code"   =>  $item,
                "syspro" =>  $sysproValue,
                "class"  => $class,
            ];
        }

        return view('index::options.compareIndexToSyspro', ['option'=>$option, 'results'=>$output ] );
    }



    /**
     *
     * @param Option $option
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function importComponentsFromSyspro( Option $option )
    {
    	DB::table('components')
		    ->where('component_part_category','!=','N')
		    ->where('option_id', $option->id)
		    ->delete();


	    $syspro = DB::connection('syspro')
		    ->table('BomStructure')
		    ->where('ParentPart', $option->option_syspro_phantom)
		    ->leftJoin('InvMaster', 'BomStructure.Component', '=', 'InvMaster.StockCode')
		    ->get();

	    foreach($syspro as $sys)
	    {
	    	$component = new Component([
			    'option_id'                 =>  $option->id,
			    'component_sub_assembly'    =>  'MF1',
			    'component_stock_code'      =>  trim( $sys->Component ),
			    'component_description'     =>  trim( $sys->Description ),
			    'component_long_description'=>  trim( $sys->LongDesc ),
			    'component_part_category'   => trim( $sys->PartCategory ),
			    'component_material_qty'    => (float) trim( $sys->QtyPer ),
			    'component_material_cost'   => (float) $sys->MaterialCost,
			    'component_price_category'   => trim( $sys->PriceCategory ),

			    'component_unit_of_measure' => trim( $sys->CostUom ),
				 'component_revision'       => 0,
			    'component_item_code'       => '',
			    'component_where_built_location' => '',
			    'component_install_area'    => '',
			    'component_notes'           => '',
		    ]);

	    	$component->save();
	    }

	    return redirect("option/{$option->id}");
    }





}
