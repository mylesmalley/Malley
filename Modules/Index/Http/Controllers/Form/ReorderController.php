<?php

namespace Modules\Index\Http\Controllers\Form;

use App\Models\Form;
use App\Models\FormElement;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\View\View;
use \Illuminate\Http\RedirectResponse;


class ReorderController extends Controller
{


    /**
     * returns a form that allows the user to reorder Blueprint Forms
     */
    public function show( Form $form ): View
    {
//        if (Gate::denies('option_editor') ) return view('index::app.access_denied');
        $form->with('basevan', 'elements');

        return view('index::index.forms.reorder', [
            'form' => $form,
            'count' => $form->elements->count(),
            'elements' => $form->elements()
                ->orderBy('position')
                ->get(),
        ]);
    }



    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function move( Request $request ): RedirectResponse
    {
//        dd( $request->all() );

        $item = FormElement::find($request->input('form_element_id'));
        $item->update([
            'position' => $request->input('position'),
        ]);


        $this->sortItems( $item->form );


        return redirect()->back()->with('message','moved');
    }


    /**
     * @param FormElement $formElement
     */
    public function sortItems( Form $form )
    {
        $items = $form
            ->elements()
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
}
