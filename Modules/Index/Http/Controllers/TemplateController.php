<?php

namespace Modules\Index\Http\Controllers;

use \App\Models\Template;
use \App\Models\TemplateOption;
use Illuminate\Http\Request;
use App\Models\BaseVan;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;
use \Illuminate\View\View;

class TemplateController extends Controller
{
    /**
     * @param BaseVan $baseVan
     * @return View
     */
	public function index( BaseVan $baseVan ): View
	{

		return view( 'index::templates.index', [
			'baseVan' => $baseVan,
			'templates_shared' => $baseVan
				->templates()
				->where( [ 'sales_drawing' => 1, 'production_drawing' => 1 ] )
				->get(),
			'templates_sales' => $baseVan
				->templates()
				->where( [ 'sales_drawing' => 1, 'production_drawing' => 0 ] )
				->get(),
			'templates_production' => $baseVan
				->templates()
				->where( [ 'sales_drawing' => 0, 'production_drawing' => 1 ] )
				->get()
		] );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return View
	 */
	public function create( BaseVan $basevan ): View
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

        return view( 'index::templates.create', [ 'basevan' => $basevan, 'template' => Template::class ] );
	}

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function store( Request $request )
	{

        $request->validate([
			'template' => 'required|string',
			'title' => 'required|string',
		]);

		// save new version
		$template = new Template( $request->except( [ 'id' ] ) );

		$template->save();
		$template->page_id = $template->id;
		$template->save();

		return redirect( 'basevan/' . $template->base_van . '/templates' );
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param \App\Models\Template $template
	 * @return View
	 */
	public function edit( BaseVan $basevan, Template $template ): View
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

        $images = DB::table( 'form_elements' )
			->where( 'forms.base_van_id', $basevan->id )
			->join( "forms", "forms.id", '=', "form_elements.form_id" )
			->where( 'form_elements.type', 'images' )
			->select( 'form_elements.id', 'form_elements.type', 'form_elements.label' )
			->get();

		$imageNames = [];

		foreach ( $images as $image ) {
			$imageNames[] = str_replace( [ ' ', '&' ], '', strtolower( $image->label ) ) . '.png';
		}

		return view( 'index::templates.edit', [
			'basevan' => $basevan,
			'template' => $template,
			'imageNames' => $imageNames ] );
	}

    /**
     * @param Request $request
     * @param BaseVan $baseVan
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function update( Request $request, BaseVan $baseVan, Template $template )
	{
		$template->update( $request->all() );
		return redirect( 'basevan/' . $template->base_van . '/templates' );
	}

    /**
     * @param Template $template
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * @throws \Exception
     */
	public function destroy( Template $template )
	{
		// delete the associated options
		DB::table( 'template_options' )
			->where( 'template_id', $template->id )
			->delete();

		$van = $template->platform();

		$template->delete();

		return redirect( "/basevan/{$van->id}/templates" );
	}


    /**
     * @param BaseVan $basevan
     * @param Template $template
     * @return View
     */
	public function templateOptions( BaseVan $basevan, Template $template ): View
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

		// ids of options that are currently tied to the template
		$ids = $template->options->pluck( 'id' )->toArray();

		$options = \App\Models\Option::where( 'base_van_id', $basevan->id )->with( 'templates' )->orderBy( 'option_name', 'ASC' )->get();

		return view( 'index::templates.templateOptions', [
			'template' => $template,
			'basevan' => $basevan,
			'options' => $options,
			'currentOptions' => $ids,
		] );
	}


    /**
     * @param BaseVan $basevan
     * @param Template $template
     * @return View
     */
    public function cleanTemplateOptionsView( BaseVan $basevan, Template $template ): View
    {
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');

        // ids of options that are currently tied to the template
        $ids = $template->options->pluck( 'id' )->toArray();

        $options = \App\Models\Option::where( 'base_van_id', $basevan->id )->with( 'templates' )->orderBy( 'option_name', 'ASC' )->get();

        return view( 'index::templates.printView', [
            'template' => $template,
            'basevan' => $basevan,
            'options' => $options,
            'currentOptions' => $ids,
        ] );
    }



    /**
     * @param BaseVan $basevan
     * @param Template $template
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
	public function storeTemplateOptions( BaseVan $basevan, Template $template, Request $request )
	{
		DB::table( 'template_options' )
			->where( 'template_id', $template->id )
			->delete();

		if ( count( $request->option ) ) {
			foreach ( $request->option as $opt ) {
				$t = new TemplateOption( [
					'template_id' => $template->id,
					'option_id' => $opt,
				] );
				$t->save();
			}
		}

		return redirect( "/basevan/{$basevan->id}/templates/{$template->id}/edit" );
	}


    /**
     * @param BaseVan $basevan
     * @return \Illuminate\Contracts\View\Factory|View
     */
	public function reorder( BaseVan $basevan )
	{
        if (Gate::denies('option_editor') ) return view('index::app.access_denied');


        return view( 'templates.reorder',
			[
				"total" => $basevan->templates->count(),

				'templates' => $basevan->templates,
				'baseVan' => $basevan,
			] );
	}


    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
	public function storeReorder( Request $request )
	{
		$templates = $request->templates;
		$positions = $request->positions;

		for ( $i = 0; $i < count( $templates ); $i++ ) {
			$template = Template::find( $templates[ $i ] );
			$template->order = $positions[ $i ];
			$template->save();
		}

		return redirect()->back();

	}

//    /**
//     * @param BaseVan $basevan
//     * @param Template $template
//     */
//	public function clone( BaseVan $basevan, Template $template )
//	{
//		$templates = Template::find([ 13,27,28,29,30,33,34,39,40,41,43 ]);
//
//		foreach( $templates as $template)
//		{
//
//
//		// clone the actual blueprint
//		$clone = $template->replicate();
//		$clone->sales_drawing = false;
//		$clone->production_drawing = true;
//		$clone->save();
//
//		$options = $template->options->pluck('id');
//
//		$newOptions = [];
//
//		// clone options
//		foreach ( $options as $opt ) {
//			$newOptions[] = ["option_id"=> $opt, 'template_id'=>$clone->id ];
//		}
//
//		DB::table('template_options')->insert( $newOptions );
//
//		}
//		echo "success";
//	}

}
