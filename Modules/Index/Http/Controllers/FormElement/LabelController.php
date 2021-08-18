<?php

namespace Modules\Index\Http\Controllers\FormElement;


use App\Models\FormElement;
use App\Models\Form;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\View\View;

class LabelController extends Controller
{
    use SharedActionsTrait;


    /**
     * @param Form $form
     * @return View
     */
    public function create( Form $form ): View
    {
        return view('index::index.forms.elements.labels.create', [
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

        return redirect( "index/forms/labels/{$el->id}")
            ->with(['success'=>['Saved new label block']]);
    }


    /**
     * @param Request $request
     * @return RedirectResponse
     */
    public function update( Request $request ): RedirectResponse
    {
        $request->validate([
            'form_element_id' => 'required|int',
            'label' => 'required|string|max:50',
            'indent' => 'sometimes|integer',
        ]);

        $el = FormElement::where( 'id', $request->input('form_element_id') )->first();
        $el->update([
            'label' => $request->input('label'),
            'indent' => $request->input('indent'),
        ]);

        $el->save();

        return redirect()
            ->back()
            ->with(['success'=>['Saved changes to label block details']]);
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
            'form',
        ]);


        return view('index::index.forms.elements.labels.edit', [
            'basevan' => $baseVan,
            'form' => $form,
            'element' =>$formElement,
        ]);
    }





}
