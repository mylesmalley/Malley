<?php

namespace Modules\Index\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use \Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Illuminate\Http\RedirectResponse;

/*
 * handles what options are associated to a given template.
 */
class OptionController extends Controller
{

    /**
     * A button next to the option adds it to the given template
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Request $request ): RedirectResponse
    {
        $request->validate([
            'option_id' => 'required|int',
            'template_id' => 'required|int',
        ]);

        DB::table('template_options')
            ->insert([
                'option_id' => $request->input('option_id'),
                'template_id' => $request->input('template_id')
            ]);

        return redirect()->back();
    }


    /**
     * remove the selected option id from the template provided
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove( Request $request )
    {
        $request->validate([
            'option_id' => 'required|int',
            'template_id' => 'required|int',
        ]);

        DB::table('template_options')
            ->where([
                'option_id' => $request->input('option_id'),
                'template_id' => $request->input('template_id')
            ])->delete();

        return redirect()->back();
    }

}
