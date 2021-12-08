<?php

namespace Modules\Index\Http\Controllers\Template;

use App\Http\Controllers\Controller;
use App\Models\BaseVan;
use App\Models\Option;
use App\Models\Template;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;

/*
 * handles what options are associated to a given template.
 */
class OptionController extends Controller
{


    /**
     * Shows a view listing active options on a given template.
     *
     * @param BaseVan $baseVan
     * @param Template $template
     * @return Response
     */
    public function options( BaseVan $baseVan, Template $template ): Response
    {
        //   $template->with('options');

        // get the ids of options already on the layout
        $active = DB::table('template_options')
            ->where('template_id', $template->id)
            ->pluck('option_id');


        // grab those options
        $activeOptions = Option::whereIn('id', $active )
            ->orderBy('option_name')
            ->get();


        // use that list to filter out used ones to return the rest.
        $remainingOptions = Option::whereNotIn('id', $active )
            ->where('obsolete',false )
            ->where('base_van_id', $baseVan->id )
            ->orderBy('option_name')
            ->get();


        return response()
            ->view('index::index.templates.options', [
                'activeOptions' => $activeOptions,
                'remainingOptions' => $remainingOptions,
                'basevan' => $baseVan,
                'template' => $template,
            ]);
    }



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
    public function remove( Request $request ): RedirectResponse
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
