<?php

namespace Modules\Index\Http\Controllers\FormElement;

use App\Models\FormElementItem;
use App\Models\FormElement;
use App\Models\Option;
use App\Models\Form;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use \Illuminate\Http\RedirectResponse;
use \Illuminate\View\View;

class CheckboxController extends Controller
{
    use SharedActionsTrait;


    /**
     * @param Form $form
     * @return View
     */
    public function create( Form $form ): View
    {
        return view('index::index.forms.elements.checkbox.create', [
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

        return redirect( "index/forms/checkbox/{$el->id}")
            ->with(['success'=>['Saved new selection block']]);
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
            ->with(['success'=>['Saved changes to checkbox block details']]);
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
            'form',
        ]);

        $except = FormElementItem::where('form_element_id', $formElement->id)
            ->where('option_id','!=',null)
            ->pluck('option_id');


        $allOptions=  $baseVan->options->where('obsolete',false)
            ->pluck('id');


        $query = Option::whereIn('id', $allOptions)
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
            ->where('model','option')
            ->orderBy('name','ASC')
            ->pluck('name','id')
            ->toArray();


        $existingrules = ($formElement->rule) ? json_decode( $formElement->rule->options ) : [];

        //  dd( $existingrules );

        $allOptions=  $baseVan->options->where('obsolete',false)
            ->pluck('id');


        $rulesQuery = Option::whereIn('id', $allOptions)
            ->whereNotIn('option_name', $existingrules )
            ->with('tags');

        if ( isset( $request->filter )  )
        {
            $rulesQuery->whereHas('tags', function( $q ) use ($request) {
                $q->where('tag_id', $request->filter );
            });
        }

        $potentialRules = $rulesQuery->get();
        //  dd($potentialRules);


        return view('index::index.forms.elements.checkbox.edit', [
            'basevan' => $baseVan,
            'form' => $form,
            'categories' => $categories,
            'element' =>$formElement,
            'count' => $formElement->items->count(),
            'existingRules' =>  ($formElement->rule) ? $formElement->rule->ruleOptions() : [],
            'availableRules' => $potentialRules,
            'available' => $media,
        ]);
    }





}
