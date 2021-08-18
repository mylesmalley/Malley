<?php

namespace Modules\Index\Http\Controllers;

use App\Models\LayoutOption;
use App\Http\Requests\LayoutOptionRequest;
use App\Models\Layout;


class LayoutOptionController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Layout $layout)
    {
        return view('index::layoutoptions.create', ['layout'=>$layout ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LayoutOptionRequest $request, Layout $layout)
    {
        // save new version if qty is greater than 0
	    if ($request->qty > 0) {
		    $layoutOption = new LayoutOption( $request->only( [ 'option_id', 'layout_id', 'qty' ] ) );

		    $layoutOption->save();
	    }
        return redirect('basevan/'.$layout->base_van_id.'/layouts/'.$layout->id );
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\LayoutOption  $layoutOption
     * @return \Illuminate\Http\Response
     */
    public function edit(Layout $layout, LayoutOption $layoutOption)
    {
        return view('index::layoutoptions.edit', [ 'layout' => $layout, 'layoutOption'=>$layoutOption ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\LayoutOption  $layoutOption
     * @return \Illuminate\Http\Response
     */
    public function update(LayoutOptionRequest $request, Layout $layout, LayoutOption $layoutOption)
    {
        $layoutOption->update( $request->all() );
        return redirect('basevan/'.$layout->base_van_id.'/layouts/'.$layout->id );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\LayoutOption  $layoutOption
     * @return \Illuminate\Http\Response
     */
    public function destroy(Layout $layout, LayoutOption $layoutOption)
    {
        $layoutOption->delete();
        return redirect('basevan/'.$layout->base_van_id.'/layouts/'.$layout->id );
    }
}
