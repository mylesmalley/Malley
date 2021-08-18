<?php

namespace Modules\Index\Http\Controllers\FormElement;


use App\Models\BaseVan;
use App\Models\Form;
use App\Models\FormElement;
use App\Models\Media;
use App\Http\Controllers\Controller;
use App\Models\FormElementItem;
use App\Models\Tag;
use \Illuminate\View\View;
USE Illuminate\Http\Request;


class FormElementController extends Controller
{

    /**
     * @param BaseVan $baseVan
     * @param Form $form
     * @return View
     */
    public function show( BaseVan $baseVan, Form $form, FormElement $formElement, Request $request ): View
    {
;

        $formElement->load([
            'items' => function ($query) {
                $query->orderBy('position', 'asc');
            },
            'items.option',
            'items.media',
            'form',
        ]);

        $except = FormElementItem::where('form_element_id', $formElement->id)
            ->where('media_id','!=',null)
            ->pluck('media_id');


        $allOptions=  $baseVan->options->where('obsolete',false)
            ->pluck('id');


        $query = Media::where('model_type', 'App\Models\Option')
            ->whereIn('model_id', $allOptions)
            ->where('collection_name','drawings')
            ->whereNotIn('id', $except)
            ->with('tags');


        if ( isset( $request->filter )  )
            {
                $query->whereHas('tags', function( $q ) use ($request) {
                    $q->where('tag_id', $request->filter );
                });

            }



            $media = $query->get();
//            dd( $media );


      //  dd( $request->filter ?? 'no filter');

         //       dd( $media);

//        dd(
//            $baseVan->options()
//                ->with('media')
//            ->where('obsolete', false )
//            ->whereHas('media', function( $query) use ($except) {
//                $query->where('collection_name', 'drawings')
//                    ->whereNotIn('id', $except);
//            })->get()
//        );

        if( $formElement->type === 'images')
        {
            $categories = Tag::where('base_van_id', $baseVan->id )
                ->where('model','drawing')
                ->orderBy('name','ASC')
                ->pluck('name','id')
                ->toArray();

            return view('index::index.forms.elements.images.edit', [
                'basevan' => $baseVan,
                'form' => $form,
                'categories' => $categories,
                'element' =>$formElement,
                'count' => $formElement->items->count(),
                'available' => $media,
            ]);
        }
        else
        {
            return view('index::index.forms.elements.images.show', [
                'basevan' => $baseVan,
                'form' => $form,
                'element' =>$formElement,
                'available' => $media,

            ]);
        }

    }

}
