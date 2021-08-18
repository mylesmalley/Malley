<?php

namespace Modules\Index\Http\Controllers\Layout;

use App\Models\BaseVan;
use App\Models\Layout;
use App\Models\Option;
use App\Http\Controllers\Controller;
use \Illuminate\View\View;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{

    /**
     * Shows a list of all available layouts for a platform
     *
     * @param BaseVan $baseVan
     * @return View
     */
    public function index(BaseVan $baseVan): View
    {
        $layouts = $baseVan
            ->layouts()
            // grab the questions and question answers relation to generate the path to the layout
            ->with('questions','questions.ancestors')
            ->get();

        return view('index::index.layouts.index', [
            'basevan' => $baseVan,
            'layouts' => $layouts,
        ]);
    }


    /**
     * Show a view for a single layout. Loads options to be associated or removed.
     *
     * @param BaseVan $baseVan
     * @param Layout $layout
     * @return View
     */
    public function show( BaseVan $baseVan, Layout $layout ): View
    {
        $layout->with('associatedOptions');

        // get the ids of options already on the layout
        $active = DB::table('layout_options')
            ->where('layout_id', $layout->id)
            ->pluck('option_id');


        // grab those options
        $activeOptions = Option::whereIn('id', $active )
            ->orderBy('option_name')
            ->get();


        // use that list to filter out used ones to return the rest.
        $remainingOptions = Option::whereNotIn('id', $active )
            ->where('obsolete',false )
            ->where('base_van_id', $layout->base_van_id )
            ->orderBy('option_name')->get();


        return view('index::index.layouts.show', [
            'activeOptions' => $activeOptions,
            'remainingOptions' => $remainingOptions,
            'basevan' => $baseVan,
            'layout' => $layout,
        ]);
    }

}
