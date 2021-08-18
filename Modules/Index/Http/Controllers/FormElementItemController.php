<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormElementItemRequest;
use App\Models\BaseVan;
use App\Models\Form;
use App\Models\FormElement;
use App\Models\FormElementItem;
use App\Models\Option;
use App\Models\Media;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use \Illuminate\View\View;

class FormElementItemController extends Controller
{
	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function create( BaseVan $baseVan, Form $form, FormElement $element )
    {
    	$this->authorize('create', FormElementItem::class );

    	return view('index::OLD.forms.items.create', [
    		'baseVan' => $baseVan,
    		'options' => Option::where('base_van_id', $baseVan->id )
			        ->select(['id','option_name','option_description'])
			        ->orderBy('option_name','ASC')
			        ->get(),
		    'media' => Media::where('base_van_id', $baseVan->id )->pluck('name','id')->toArray(),
		    'form' => $form,
		    'element' => $element,
	    ]);
    }

	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
    public function store( BaseVan $baseVan, Form $form, FormElement $element, FormElementItemRequest $request )
    {
    	$this->authorize('create', FormElementItem::class );
    	$x = new FormElementItem( $request->all() );
	    $element->items()->save( $x );
    	return redirect('/basevan/'.$baseVan->id.'/forms/'.$form->id );
    }

	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @param FormElementItem $item
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit( BaseVan $baseVan, Form $form, FormElement $element, FormElementItem $item )
	{
		$this->authorize('update', $item );

		return view('index::OLD.forms.items.edit', [
			'baseVan' => $baseVan,
			'options' => Option::where('base_van_id', $baseVan->id )->select(['id','option_name','option_description'])
				->orderBy('option_name','ASC')->get(),
			'media' => Media::where('base_van_id', $baseVan->id )->pluck('name','id')->toArray(),
			'form' => $form,
			'element' => $element,
			'item' => $item,
		]);
	}

	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @param FormElementItem $item
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function update( BaseVan $baseVan, Form $form, FormElement $element, FormElementItem $item, FormElementItemRequest $request  )
	{
		$this->authorize('update', $item );

		$item->update( $request->only( ['option_id','media_id'] ) );
		return redirect('/basevan/'.$baseVan->id.'/forms/'.$form->id );
	}


	/**
	 ` @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @param FormElementItem $item
	 * @return \Illuminate\Http\RedirectResponse
	 * @throws \Exception
	 */
    public function delete( BaseVan $baseVan, Form $form, FormElement $element, FormElementItem $item )
    {
    	$this->authorize('delete', $item);
    	$item->delete();
    	return back();
    }


	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
    public function reorder(BaseVan $baseVan, Form $form, FormElement $element )
    {
    	return view('index::OLD.forms.items.reorder', [
    		'items'=> $element->items,
		    "total"=>$element->items->count(),
	    	'baseVan' => $baseVan,
		    'form' => $form,
			'element' => $element,
	    ]);
    }


	/**
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
    public function submitReorder( Request $request )
    {
    	$items = $request->items;
    	$positions = $request->positions;

    	//dd( $items, $positions );

    	for( $i = 0; $i < count($items); $i++ )
	    {
	        $item = FormElementItem::find( $items[$i] );
	        $item->position = $positions[$i];
	        $item->save();
	    }

	    return redirect()->back();

    }


    /**
     * @param FormElementItem $item
     * @return View
     */
    public function newEdit( FormElementItem $item )
    {
        if ( $item->element->type === 'images')
        {
            echo "images form";
        }
        echo "regular form";
    }




}
