<?php
namespace Modules\Index\Http\Controllers;

use App\Models\BaseVan;
use App\Models\Option;
use Illuminate\Http\Request;
use App\Http\Requests\BaseVanRequest;
use Illuminate\Support\Facades\Auth;

class BaseVanController extends Controller
{

	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('index::basevan.index', [
        	'basevans'=> BaseVan::orderBy('name')
		        ->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('index::basevan.create',[ 'basevan'=> BaseVan::class ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BaseVanRequest $request)
    {
        //dd($request);
        $basevan = new BaseVan( $request->all() );
        $basevan->save();
        return redirect('basevan');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\BaseVan  $baseVan
     * @return \Illuminate\Http\Response
     */
    public function show(BaseVan $baseVan)
    {


    	if ( ! Auth::user()->show_blueprint_options )
	    {
		    $options = Option::with(['components','media'])
			    ->where('base_van_id', $baseVan->id )
			    ->where('blueprint_only', 0 )
			    ->orderBy('option_name')
			    ->with('components')
			    ->get();
	    }
	    else
	    {
		    $options = Option::with(['components','media'])
			    ->where('base_van_id', $baseVan->id )
			    ->orderBy('option_name')
			    ->with('components')
			    ->get();
	    }

    	$jira = null;
//    	$jira = new Jira();
//    	$jira = $jira->searchByOptionNumber( $baseVan->optionPrefix );
//
        return view('index::options.index',['baseVan'=>$baseVan, 'jira'=>$jira, "options"=> $options ]);
//        return view('index::index::test' );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\BaseVan  $baseVan
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseVan $baseVan)
    {
        return view('index::basevan.edit',[ 'baseVan'=> $baseVan ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\BaseVan  $baseVan
     * @return \Illuminate\Http\Response
     */
    public function update(BaseVanRequest $request, BaseVan $baseVan)
    {
        $baseVan->update( $request->only(['name','visibility']) );
        return redirect('basevan/'.$baseVan->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\BaseVan  $baseVan
     * @return \Illuminate\Http\Response
     */
    public function destroy(BaseVan $baseVan)
    {
        //
    }
}
