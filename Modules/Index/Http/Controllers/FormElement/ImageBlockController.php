<?php

namespace Modules\Index\Http\Controllers\FormElement;


use App\Models\FormElementItem;
use App\Models\FormElement;
use App\Models\Media;
use App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\View\View;

class ImageBlockController extends Controller
{
    use SharedActionsTrait;


    /**
     * @param Form $form
     * @return View
     */
    public function create( Form $form ): View
    {
        return view('index::index.forms.elements.images.create', [
            'basevan' => $form->basevan,
            'form' => $form,
        ]);
    }

    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function store( Request $request ): RedirectResponse
    {
        $request->validate([
            'form_id' => 'required|int',
            'label' => 'required|string|max:50',
            'indent' => 'sometimes|integer',
            'type' => 'required|string',
        ]);

        $el = FormElement::create( $request->only(['form_id','label','indent','type']));

        $el->save();

        return redirect( "index/forms/imageblock/{$el->id}");
    }


    public function update( Request $request )
    {
        $request->validate([
            'form_element_id' => 'required|int',
            'label' => 'required|string|max:50',
            'indent' => 'sometimes|integer',
        ]);


     //   dd( $request->all() );
        $el = FormElement::where( 'id', $request->input('form_element_id') )->first();
            $el->update([
                'label' => $request->input('label'),
                'indent' => $request->input('indent'),
            ]);

            $el->save();
        return redirect()
            ->back()
            ->with(['success'=>['Saved changes to image block details']]);
    }

    /**
     * @param FormElement $formElement
     * @param Request $request
     * @return View
     */
    public function edit( FormElement $formElement, Request $request ): View
    {
        $form = $formElement->form;
        $baseVan = $form->basevan;


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


        $query = Media::where('model_type', \App\Models\Option::class)
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



}
