<?php

namespace Modules\Index\Http\Controllers\Template;

use App\Models\BaseVan;
use App\Models\Template;
use App\Models\Option;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;


class IndexController extends Controller
{

    /**
     * Shows a list of all available layouts for a platform
     *
     * @param BaseVan $baseVan
     * @return Response
     */
    public function index(BaseVan $baseVan): Response
    {
        $templates = $baseVan
        ->templates()
        ->where( [ 'sales_drawing' => 1,
            'pdf' => 1,
            'production_drawing' => 0 ] )
        ->get();

        return response()
            ->view('index::index.templates.index', [
                'basevan' => $baseVan,
                'templates' => $templates,
            ]);
    }










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

}
