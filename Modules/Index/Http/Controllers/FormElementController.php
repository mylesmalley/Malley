<?php

namespace Modules\Index\Http\Controllers;

use App\Models\FormElementItem;
use Illuminate\Http\Request;
use App\Http\Requests\FormElementRequest;
use App\Models\BaseVan;
use App\Models\Form;
use App\Models\FormElement;
use App\Models\Option;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use \Illuminate\View\View;

class FormElementController extends Controller
{
	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function create( BaseVan $baseVan, Form $form )
	{
		$this->authorize( 'create', FormElement::class );

		return view( 'OLD.forms.elements.create', [
			'baseVan' => $baseVan,
			'options' => Option::where( 'base_van_id', $baseVan->id )
				->select( [ 'id', 'option_name', 'option_description' ] )
				->orderBy( 'option_name', 'ASC' )
				->get(),
			'form' => $form ] );
	}

	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function store( BaseVan $baseVan, Form $form, FormElementRequest $request )
	{
		$this->authorize( 'create', FormElement::class );

		$x = new FormElement( $request->only( 'label', 'type', 'option_id_requirement' ) );
		$form->elements()->save( $x );
		return redirect( '/basevan/' . $baseVan->id . '/forms/' . $form->id );
	}

	/**
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $formElement
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function edit( BaseVan $baseVan, Form $form, FormElement $formElement )
	{
		$this->authorize( 'update', $formElement );

		return view( 'OLD.forms.elements.edit', [
				'baseVan' => $baseVan,
				'form' => $form,
				'options' => Option::where( 'base_van_id', $baseVan->id )
					->select( [ 'id', 'option_name', 'option_description' ] )
					->orderBy( 'option_name', 'ASC' )
					->get(),
				'formElement' => $formElement ]
		);
	}

	/**
	 * @param BaseVan $baseVan
	 * @param Form $for /m
	 * @param FormElement $formElement
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function update( BaseVan $baseVan, Form $form, FormElement $formElement, FormElementRequest $request )
	{
		$this->authorize( 'update', $formElement );

		$update = $request->only( [ 'label', 'type', 'option_id_requirement' ] );
		$formElement->update( $update );
		return redirect( '/basevan/' . $baseVan->id . '/forms/' . $form->id );
	}

//
//	/**
//	 * reorders the form elements based on user submission
//	 *
//	 * @param Request $request
//	 * @return \Illuminate\Http\JsonResponse
//	 * @throws \Illuminate\Auth\Access\AuthorizationException
//	 */
//	public function reorder( Request $request )
//	{
//		$this->authorize('reorder', FormElementItem::class );
//
//		foreach ($request->data as $e)
//		{
//			DB::table('form_elements')
//				->where('id',(int) $e[0])
//				->update([
//					'position'=> (int) $e[1]
//				]);
//
//		}
//		return response()->json([
//			"success"
//		]);
//	}
//


	/**
	 * returns a form that allows a user to re-order teh elements of a form
	 *
	 * @param BaseVan $baseVan
	 * @param Form $form
	 * @param FormElement $element
	 * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
	 */
	public function reorder( BaseVan $baseVan, Form $form )
	{
		return view( 'OLD.forms.elements.reorder', [
			'elements' => $form->elements,
			"total" => $form->elements->count(),
			'baseVan' => $baseVan,
			'form' => $form
		] );
	}


	/**
	 * store the re-ordered form elements
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function submitReorder( Request $request )
	{
		$elements = $request->elements;
		$positions = $request->positions;

		for ( $i = 0; $i < count( $elements ); $i++ ) {
			$element = FormElement::find( $elements[ $i ] );
			$element->position = $positions[ $i ];
			$element->save();
		}

		return redirect()->back();

	}


	/**
	 * @param BaseVan $basevan
	 * @param Form $form
	 * @param FormElement $formElement
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	function delete( BaseVan $basevan, Form $form, FormElement $formElement )
	{
		$this->authorize( 'delete', $formElement );

		$formElement->items()->delete();
		try {
			$formElement->delete();
		}
		catch ( \Exception $e ) {
		}
		return redirect( '/basevan/' . $basevan->id . '/forms/' . $form->id );
	}


	public function options( BaseVan $basevan, Form $form, FormElement $formElement )
	{
		$items = DB::table('form_element_items')
			->where('form_element_id', $formElement->id)
			->pluck('option_id')
			->toArray();


		return view('index::OLD.forms.items.options', [
			'basevan' => $basevan,
			'form' => $form,
			'element' => $formElement,
			'options' => Option::where('base_van_id', $basevan->id)->orderBy('option_name','ASC')->get(),
			'currentOptions' => $items,
		]);
	}


	public function updateOptions(BaseVan $basevan, Form $form, FormElement $formElement , Request $request )
	{
		$request->validate( [
			'form_element_id' => "required|integer",
			'options' => "nullable|array",
		] );

		DB::table( 'form_element_items' )
			->where( 'form_element_id', $request->form_element_id )
			->delete();

		//dd( $request->all() );

		foreach ( $request->options as $opt )
		{
			DB::table('form_element_items')
				->insert([
					'form_element_id'=>$request->form_element_id,
					'option_id'=> $opt
				]);
		}


		// 	dd( $rule );

		return redirect('/basevan/'.$basevan->id.'/forms/'.$form->id );
	}



	public function images( BaseVan $basevan, Form $form, FormElement $formElement )
	{
		$items = DB::table('form_element_items')
			->where('form_element_id', $formElement->id)
			->pluck('media_id')
			->toArray();

		$options = \App\Models\Option::where('base_van_id', $basevan->id )
				->get()
			->keyBy('id');

		$media = \App\Models\Media::where('model_type',\App\Models\Option::class)
			->select(['media.id','options.id AS option_id','options.option_name','options.option_description',
				'model_id','media.name AS media_name'])
			->where('media.base_van_id', $basevan->id)
		//	->where('media.name','like','%WEDGEWOOD%')
			->join('options','options.id','=','media.model_id')
			->orderBy('options.option_name','ASC')
			->get();

		//dd($media);

	//	dd( $media );


		return view('index::OLD.forms.items.images', [
			'basevan' => $basevan,
			'form' => $form,
			'element' => $formElement,
			'media' => $media,
			'options' => $options,
			'currentOptions' => $items,
		]);
	}






	public function updateImages(BaseVan $basevan, Form $form, FormElement $formElement , Request $request )
	{
		$request->validate( [
			'form_element_id' => "required|integer",
			'options' => "nullable|array",
		] );

		DB::table( 'form_element_items' )
			->where( 'form_element_id', $request->form_element_id )
			->delete();

		//dd( $request->all() );

		foreach ( $request->options as $opt => $media )
		{
			DB::table('form_element_items')
				->insert([
					'form_element_id'=>$request->form_element_id,
					'option_id'=> $opt,
					'media_id'=> $media,
				]);
		}


		// 	dd( $rule );

		return redirect('/basevan/'.$basevan->id.'/forms/'.$form->id );
	}
}
