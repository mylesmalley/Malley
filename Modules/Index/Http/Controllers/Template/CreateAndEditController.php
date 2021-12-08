<?php

namespace Modules\Index\Http\Controllers\Template;

use App\Models\BaseVan;
use App\Models\Template;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;
use Illuminate\Http\Request;

class CreateAndEditController extends Controller
{

    /**
     * @param BaseVan $baseVan
     * @param Template $template
     * @return Response
     */
    public function edit( BaseVan $baseVan, Template $template ): Response
    {
        return response()
            ->view('index::index.templates.edit',[
                'basevan' => $baseVan,
                'template' => $template,
            ]);
    }


    /**
     * @param BaseVan $baseVan
     * @return Response
     */
    public function create( BaseVan $baseVan ): Response
    {
        return response()
            ->view('index::index.templates.create',[
                'basevan' => $baseVan,
            ]);
    }


    /**
     * @param BaseVan $baseVan
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( BaseVan $baseVan, Request $request ): RedirectResponse
    {
        $request->validate([
            'id' => 'sometimes|int',
            'title' => 'required|string',
            'template' => 'required|string',
            'order' => 'required|int',
            'visibility' => 'required|int',
            'sales_drawing' => 'required|int',
            'production_drawing' => 'required|int',
            'pdf' =>    'required|int',
        ]);

        Template::updateOrCreate( $request->all() );

        return redirect()
            ->route('platform.templates.index', [$baseVan]);

    }

}
