<?php

namespace Modules\Index\Http\Controllers\FormElement;


use App\Models\FormElement;
use App\Models\FormElementItem;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\Http\Request;

/**
 * Trait SharedActionsTrait
 * @package App\Http\Controllers\FormElement
 */
trait SharedActionsTrait
{
    /**
     * @param FormElement $formElement
     * @return RedirectResponse
     * @throws \Exception
     */
    function delete( Request $request ): RedirectResponse
    {

        $formElement = FormElement::find( $request->input('form_element_id' ));
        $form = $formElement->form;

     //   dd( $form );

        if ( !$formElement->items->count() )
        {
            $formElement->delete();
        }

        return redirect("/index/basevan/{$form->base_van_id}/forms/{$form->id}");
    }




    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function move( Request $request ): RedirectResponse
    {
        $item = FormElementItem::find($request->input('id'));
        $item->update([
            'position' => $request->input('position'),
        ]);

        $this->sortItems( $item->formElement );


        return redirect()->back();
    }




    /**
     * @param FormElement $formElement
     */
    public function sortItems( FormElement $formElement )
    {
        $items = $formElement
            ->items()
            ->orderBy('position')
            ->get();

        $counter = 1;

        foreach ( $items as $item )
        {
            $item->update([
                'position' => $counter,
            ]);

            $item->save();
            $counter++;
        }
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function add( Request $request ): RedirectResponse
    {
        $request->validate([
            'form_element_id' => "required|int",
            'option_id' => "required|int",
            'media_id' => 'sometimes|int',
            'position' => "required|int",
        ]);

        $item = FormElementItem::create([
            'form_element_id' => $request->input('form_element_id'),
            'option_id' => $request->input('option_id'),
            'media_id' => $request->input('media_id') ?? null,
            'position' => $request->input('position'),
        ]);

        $item->save();

        $this->sortItems( $item->formElement );


        return redirect()->back();

    }




    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function remove(  Request $request  ): RedirectResponse
    {
        $request->validate([
            'id' => 'required|int',
        ]);

        $item = FormElementItem::findOrFail($request->input('id'));

        $item->delete();

        $this->sortItems( $item->formElement );


        return redirect()->back();
    }
}
