<?php

namespace Modules\Blueprint\Http\Controllers\Form;

use App\Models\Blueprint;
use App\Models\Configuration;
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

         $form_data = $form
            ->load([
                'elements',
//                'elements' => function ($query) {
//                    $query->orderBy('position', 'asc');
//                },
//                'elements.items' => function ($query) {
//                    $query->orderBy('position', 'asc');
//                },
                'elements.rule',
                'elements.items.option' => function( $query) {
                    $query->select('id','option_name', 'option_description');
                },
           //     'elements.items.option.media',
                'elements.items.media' => function( $query ) {
                    $query->select('model_id', 'id','disk');
                },//
            ])->toJson();


        return response()
            ->view('blueprint::form.show', [
            'blueprint'=>$blueprint,
//            'elements' => $form->load(['elements', 'elements.rule', 'elements.items']),
//            'configuration' => Configuration::where('blueprint_id', '=', $blueprint->id )
//                ->where('obsolete', '=', false)
//                ->select(['id', 'value', 'name', 'option_id','description'])
//                ->get()
//                ->keyBy('option_id')
//                ->toArray(),
            'form' => $form,
            'form_data' => $form_data,
            'configuration' => Configuration::where('blueprint_id','=',$blueprint->id)
                ->select('id', 'value', 'option_id')
                ->get()
                ->keyBy('option_id')
                ->toJson(),
//
//            ->load([
//                'elements',
////                'elements' => function ($query) {
////                    $query->orderBy('position', 'asc');
////                },
////                'elements.items' => function ($query) {
////                    $query->orderBy('position', 'asc');
////                },
//                'elements.rule',
//                'elements.items.option',
//                'elements.items.option.media',
//                'elements.items.media',//
//           ]),
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
