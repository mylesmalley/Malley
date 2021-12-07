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
     * @param Template|null $template
     * @return Response
     */
    public function form( BaseVan $baseVan, Template $template = null ): Response
    {



        return response()
            ->view('index::index.templates.show',[
                'basevan' => $baseVan,
                'template' => $template,
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

        ]);

        Template::updateOrCreate( $request->all() );

        return redirect()
            ->route('platform.templates.index', [$baseVan]);

    }

}
