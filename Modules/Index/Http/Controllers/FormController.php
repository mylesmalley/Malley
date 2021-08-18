<?php

namespace Modules\Index\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormModelRequest;
use App\Models\Form;
use App\Models\BaseVan;
use App\Models\FormElement;
use App\Models\FormElementItem;
use Illuminate\Support\Facades\Gate;
use \Illuminate\View\View;


class FormController extends Controller
{
    /**
     * @param BaseVan $baseVan
     * @return View
     */
    public function index( BaseVan $baseVan ): View
    {
    	return view('index::OLD.forms.index', [ 'baseVan' => $baseVan ]);
    }


    /**
     * @param BaseVan $baseVan
     * @param Form $form
     * @return View
     */
	public function show( BaseVan $baseVan, Form $form ): View
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

		return view('index::OLD.forms.show', [
			'baseVan' => $baseVan,
			'form' => $form->load([
				'elements' => function ($query) {
					$query->orderBy('position', 'asc');
				},
				'elements.rule',
				'elements.items',
				'elements.items.option'
			 ])
		]);
	}


    /**
     * @param BaseVan $baseVan
     * @return View
     */
	public function create( BaseVan $baseVan ): View
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

		return view('index::OLD.forms.create', ['baseVan'=>$baseVan]);
	}


	/**
	 * @param BaseVan $baseVan
	 * @param FormModelRequest $request
	 * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
	 * @throws \Illuminate\Auth\Access\AuthorizationException
	 */
	public function store( BaseVan $baseVan, FormModelRequest $request)
	{
		$this->authorize('create', Form::class );

		$form = new Form( $request->only(['name','visibility','standard_blueprint_form'])  );
		$form->base_van_id = $baseVan->id;
		$form->save();

		return redirect( $form->route() );
	}


    /**
     * returns a form that allows the user to reorder Blueprint Forms
     *
     * @param BaseVan $baseVan
     * @return View
     */
	public function reorder( BaseVan $baseVan ): View
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

        return view('index::OLD.forms.reorder', [
			'baseVan' => $baseVan,
			'forms' => $baseVan->forms,
			'total' => $baseVan->forms->count(),
		]);
	}


	/**
	 * Stores the newly reordered Forms
	 *
	 * @param Request $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function storeReorder( Request $request )
	{
		$forms = $request->forms;
		$positions = $request->positions;

		for( $i = 0; $i < count($forms); $i++ )
		{
			$form = Form::find( $forms[$i] );
			$form->order = $positions[$i];
			$form->save();
		}

		return redirect()->back();

	}



}
