<?php

namespace Modules\Index\Http\Controllers\Template;

use App\Models\BaseVan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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



}
