<?php

namespace Modules\Index\Http\Controllers;

use App\Models\Layout;
use App\Models\BaseVan;
use App\Http\Requests\LayoutRequest;

class LayoutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index( BaseVan $basevan )
    {

        return view('index::layouts.index',['platform'=>$basevan, 'layouts'=>$basevan->layouts ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create( BaseVan $basevan )
    {
        return view('index::layouts.create', ['basevan'=>$basevan, 'layout'=>Layout::class ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LayoutRequest $request)
    {
        // save new version
        $layout = new Layout( $request->all() );

        $layout->save();


	    return redirect('basevan/'.$layout->base_van_id.'/layouts');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Layout  $layout
     * @return \Illuminate\Http\Response
     */
    public function show(BaseVan $basevan, Layout $layout)
    {
        return view('index::layouts.show',['basevan'=>$basevan, 'layout'=>$layout ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  BaseVan $basevan [description]
     * @param  Layout  $layout  [description]
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(BaseVan $basevan, Layout $layout)
    {
        return view('index::layouts.edit', ['basevan'=>$basevan, 'layout' =>
            $layout ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Layout  $layout
     * @return \Illuminate\Http\Response
     */
    public function update(LayoutRequest $request, BaseVan $baseVan, Layout $layout)
    {
        $layout->update( $request->only(['name','notes','visibility']) );
        return redirect('basevan/'.$layout->base_van_id.'/layouts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Layout  $layout
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layout $layout)
    {
        //
    }

	/**
	 * @param Layout $layout
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function addMedia(BaseVan $basevan, Layout $layout )
	{
		return redirect()->away('https://blueprint.malleyindustries.com/media/layout/'.$layout->id);
	}


}
