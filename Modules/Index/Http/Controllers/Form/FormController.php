<?php

namespace Modules\Index\Http\Controllers\Form;

use App\Models\BaseVan;
use App\Models\Form;
use App\Http\Controllers\Controller;
use \Illuminate\View\View;


class FormController extends Controller
{

    /**
     * @param BaseVan $baseVan
     * @return View
     */
    public function index(BaseVan $baseVan): View
    {
        $forms = $baseVan->forms;
        return view('index::index.forms.index', [
            'basevan' => $baseVan,
            'forms' => $forms,
        ]);
    }


    /**
     * @param BaseVan $baseVan
     * @param Form $form
     * @return View
     */
    public function show( BaseVan $baseVan, Form $form ): View
    {
        $form = $form->load([
            'elements' => function ($query) {
                $query->orderBy('position', 'asc');
            },
            'elements.rule',
            'elements.items',
            'elements.items.option'
        ]);

        return view('index::index.forms.show', [
            'basevan' => $baseVan,
            'form' => $form,
        ]);
    }

}
