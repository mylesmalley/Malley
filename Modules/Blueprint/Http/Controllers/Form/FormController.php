<?php

namespace Modules\Blueprint\Http\Controllers\Form;

use App\Models\Blueprint;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Controller;
use Illuminate\Http\Response;
use App\Models\Form;

class FormController extends Controller
{

    /**
     * @param Blueprint $blueprint
     * @param Form $form
     * @return Response
     */
    public function show( Blueprint $blueprint,  Form $form ): Response
    {
        return response()
            ->view('blueprint::form.show', [
            'blueprint'=>$blueprint,

            'form' => $form->load([

                'elements' => function ($query) {
                    $query->orderBy('position', 'asc');
                },
                'elements.items' => function ($query) {
                    $query->orderBy('position', 'asc');
                },
                'elements.items.option',
                'elements.items.option.media',
                'elements.items.media',
                'elements.rule',

            ]),
        ]);
    }


    /**
     * @param Blueprint $blueprint
     * @return RedirectResponse
     */
    public function submit( Blueprint $blueprint): RedirectResponse
    {
        return redirect()->route('blueprint.home', [ $blueprint ])
            ->with('message','Saved changes to form');

    }


}
