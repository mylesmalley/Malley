<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\BaseVan;
use \App\Models\Form;
use \App\Models\FormElement;
use \App\Models\FormElementRule;
use \App\Models\Option;
use Illuminate\Support\Facades\Gate;
use \Illuminate\View\View;

class FormElementRuleController extends Controller
{
	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $
	 */
    public function show( BaseVan $baseVan, Form $form, FormElement $element)
    {
    	$currentOptions = ($element->rule) ? $element->rule->getOptions()->keys()->toArray() : [];

    	return view('index::OLD.forms.rules.formElementRuleOptions', [
		    'basevan' => $baseVan,
		    'form' => $form,
		    'element' => $element,
		    'options' => Option::where('base_van_id', $baseVan->id)
                ->orderBy('option_name','ASC')->get(),
		    'currentOptions' => $currentOptions,
	    ]);
    }


	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 */
    public function store( BaseVan $baseVan, Form $form, FormElement $element, Request $request )
    {
    	$request->validate([
    		'form_element_id' => "required|integer",
		    'options' => "nullable|array",
		    'operator' => "required|string",
	    ]);

    	$options = ($request->options) ?  $request->options  : [];

    	$rule = FormElementRule::updateOrCreate([ 'form_element_id'=>$request->form_element_id ],[
    		"operator" => $request->operator,
		    "options" => json_encode( $options ),
	    ]);

    	if ( count( json_decode ( $rule->options) ) === 0)
	    {
	    	$rule->delete();
	    }



   // 	dd( $rule );

	    return redirect('/basevan/'.$baseVan->id.'/forms/'.$form->id );

    }


}
