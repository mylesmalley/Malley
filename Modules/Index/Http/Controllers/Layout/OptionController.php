<?php

namespace Modules\Index\Http\Controllers\Layout;

use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\RedirectResponse;

/*
 * handles what options are associated to a given layout.
 */
class OptionController extends Controller
{

    /**
     * A button next to the option adds it to the given layout
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Request $request ): RedirectResponse
    {
        $request->validate([
            'option_id' => 'required|int',
            'layout_id' => 'required|int',
        ]);

        DB::table('layout_options')
            ->insert([
                'option_id' => $request->input('option_id'),
                'layout_id' => $request->input('layout_id')
            ]);

        return redirect()->back();
    }


    /**
     * remove the selected option id from the layout provided
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove( Request $request )
    {
        $request->validate([
            'option_id' => 'required|int',
            'layout_id' => 'required|int',
        ]);

        DB::table('layout_options')
            ->where([
                'option_id' => $request->input('option_id'),
                'layout_id' => $request->input('layout_id')
            ])->delete();

        return redirect()->back();
    }

}
