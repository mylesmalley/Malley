<?php


use Illuminate\Support\Facades\Route;
use \Modules\Index\Http\Controllers\Component\ComponentController;
use \Modules\Index\Http\Controllers\Component\HomeController;
use \Modules\Index\Http\Controllers\Component\ImportPhantomController;
use Modules\Index\Http\Controllers\Index\ComponentListController;
use Modules\Index\Http\Controllers\Index\PricingController;
use Modules\Index\Http\Controllers\Index\WizardController;
use Modules\Index\Http\Controllers\Option\WizardImageController;
use Modules\Index\Http\Controllers\Template\CreateAndEditController;
use Modules\Index\Http\Controllers\Template\IndexController;


Route::group(["prefix" => "index"], function(){

 //    Route::resource('basevan', "Modules\Index\Http\Controllers\BaseVanController");

    Route::get('preferences', "Option\IndexController@editPreferences");
    Route::patch('preferences', "Option\IndexController@savePreferences");




    Route::group(['prefix' => 'basevan/{basevan}'], function () {
        // option index home page
        Route::get('/', "Option\IndexController@show")
            ->name('platform.home');


        Route::get('/wizards', [WizardController::class, 'index'])
            ->name('platform.wizards');

        Route::get('/wizard/create', [WizardController::class, 'create'])
            ->name('platform.wizard.create');

        Route::post('/wizard/create', [WizardController::class, 'store'])
            ->name('platform.wizard.store');


        /**
         * PRICING FOR INDEXES
         */
        Route::get('/pricing', [PricingController::class, 'index'])
            ->name('platform.pricing.index');










        // create a new option for a platform
        Route::get('/create', "Option\CreateController@create");
        Route::post('/', "Option\CreateController@store");

        Route::post('/tag', "Index\TagController@create")
            ->name('platform.tags.create');

        Route::get('/componentList', [ ComponentListController::class, 'report'])
            ->name('platform.component_list_report');


        // forms
        Route::get('/forms', "Form\FormController@index");
        Route::get('/forms/{form}', "Form\FormController@show");

        Route::get('/forms/{form}/element/{formElement}', "FormElement\FormElementController@show");


        // layouts rev 2
        Route::get('/layouts', "Layout\IndexController@index");
        Route::get('/layouts/{layout}', "Layout\IndexController@show");
        Route::post('/layouts/{layout}', "Layout\OptionController@add");
        Route::delete('/layouts/{layout}', "Layout\OptionController@remove");


        // TEMPLATES rev 2



        Route::get('/templates/{template?}', [CreateAndEditController::class, "form"])
            ->name('platform.templates.create_or_edit');

        Route::post('/templates', [CreateAndEditController::class, "store"])
            ->name('platform.templates.store');

        Route::get('/templates', [IndexController::class, "index"])
            ->name('platform.templates.index');

        Route::get('/templates/{template}/options', "Template\IndexController@options");
        //   Route::post('/templates/{template}', "Template\OptionController@add");
//        Route::delete('/templates/{template}', "Template\OptionController@remove");






    });





    Route::get('/forms/{form}/reorder', "Form\ReorderController@show");
    Route::patch('/forms/{form}/reorder', "Form\ReorderController@move");

    /** NEW IMAGE BLOCK CREATION */
    Route::group(['prefix' => '/forms/imageblock/'], function () {
        Route::get('create/{form}', "FormElement\ImageBlockController@create");
        Route::post('create', "FormElement\ImageBlockController@store");
        Route::patch('edit', "FormElement\ImageBlockController@update");
        Route::delete('delete', "FormElement\ImageBlockController@delete");
        Route::get('{formElement}', "FormElement\ImageBlockController@edit");
        Route::post('', "FormElement\ImageBlockController@add");
        Route::delete('', "FormElement\ImageBlockController@remove");
        Route::patch('', "FormElement\ImageBlockController@move");
    });

    /** NEW SELECTION BLOCK CREATION */
    Route::group(['prefix' => '/forms/selection/'], function () {
        $c = "FormElement\SelectionController@";
        Route::get('create/{form}', $c."create");
        Route::post('create', $c."store");
        Route::patch('edit', $c."update");
        Route::delete('delete', $c."delete");
        Route::get('{formElement}', $c."edit");
        Route::post('', $c."add");
        Route::delete('', $c."remove");
        Route::patch('', $c."move");
    });

    /** NEW SELECTION BLOCK CREATION */
    Route::group(['prefix' => '/forms/checkbox/'], function () {
        $c = "FormElement\CheckboxController@";
        Route::get('create/{form}', $c."create");
        Route::post('create', $c."store");
        Route::patch('edit', $c."update");
        Route::delete('delete', $c."delete");
        Route::get('{formElement}', $c."edit");
        Route::post('', $c."add");
        Route::delete('', $c."remove");
        Route::patch('', $c."move");
    });


    /** NEW LABEL BLOCK  */
    Route::group(['prefix' => '/forms/labels/'], function () {
        $c = "FormElement\LabelController@";
        Route::get('create/{form}', $c."create");
        Route::post('create', $c."store");
        Route::patch('edit', $c."update");
        Route::delete('delete', $c."delete");
        Route::get('{formElement}', $c."edit");
        Route::post('', $c."add");
        Route::delete('', $c."remove");
        Route::patch('', $c."move");
    });

    /** NEW QUANTITY BLOCK  */
    Route::group(['prefix' => '/forms/quantity/'], function () {
        $c = "FormElement\QuantityController@";
        Route::get('create/{form}', $c."create");
        Route::post('create', $c."store");
        Route::patch('edit', $c."update");
        Route::delete('delete', $c."delete");
        Route::get('{formElement}', $c."edit");
        Route::post('', $c."add");
        Route::delete('', $c."remove");
        Route::patch('', $c."move");
    });


    /** NEW RULES BLOCK CREATION */
    Route::group(['prefix' => '/forms/rules/'], function () {
        $c = "FormElement\RuleController@";
        Route::post('', $c."add");
        Route::delete('', $c."remove");
        Route::patch('', $c."move");
    });






























        Route::group(['prefix' => 'option'], function () {
        Route::get('{option}/home','Option\HomeController@show')
        ->name('option.home');

        // index2 option revision
        Route::get('{option}/revision','Option\RevisionController@create');
            Route::post('revision','Option\RevisionController@store');
            Route::post('revisionFromComponentsPage','Option\RevisionController@revisionFromComponentsPage');
//            Route::post('revisionFromLivewirePricing',[RevisionController::class, 'generate_revision_from_pricing_livewire_component'])
//                ->name('option.revision.create_from_livewire_pricing');

        Route::get('{option}/retire','Option\RetireController@form');
        Route::post('retire','Option\RetireController@retire');

        Route::get('{option}/clone','Option\CloneController@form');
        Route::post('clone','Option\CloneController@clone');



        Route::delete('{option}/delete', 'Option\DeleteController@delete');


        Route::get('/{option}/tags',    "Option\TagController@optionTags");
        Route::delete('/{option}/tag/{tag}',    "Option\TagController@delete");
        Route::post('/{option}/tag/{tag}',    "Option\TagController@create");


        Route::get('/{option}/templates',    "Option\TemplateController@optionTemplates");
        Route::delete('/{option}/templates/{template}',    "Option\TemplateController@remove");
        Route::post('/{option}/templates/{template}',    "Option\TemplateController@add");


        // usage of this option in Blueprint
        Route::get('/{option}/usage',    "Option\UsageController@show")
            ->name('option.usage');



        // main option routes
		Route::get('/', 'OptionController@index');
//		Route::get('{basevan}/create','OptionController@create');
		Route::post('/', 'OptionController@store');
		Route::get('/{option}', 'OptionController@show');
		Route::get('/{option}/edit', 'OptionController@edit');
		Route::put('/{option}', 'OptionController@update');
		Route::patch('/{option}', 'OptionController@update');
		Route::delete('/{option}', 'OptionController@destroy');



		// rules
		Route::get('{option}/rules', "Option\RuleController@rules");
		Route::post('{option}/rules', "Option\RuleController@store");



		// components
		Route::get('/{option}/component','ComponentController@create');
		Route::get('/{option}/compare','OptionController@compareIndexToSyspro');

		Route::get('/{option}/importComponentsFromSyspro', 'OptionController@importComponentsFromSyspro');

            // NEW COMPONENTS
            Route::get('/{option}/components',[HomeController::class, 'home']);
            Route::post('/{option}/components',[ComponentController::class, 'add']);
            Route::delete('/{option}/components',[ComponentController::class, 'delete']);

            Route::post('importComponentsFromSyspro', [ImportPhantomController::class, 'import'])->name('importComponents');


		// photos
        Route::get('/{option}/photos', 'Option\PhotoController@index');
        Route::post('/{option}/photos', 'Option\PhotoController@create');
        Route::delete('/{option}/photos/{media}', 'Option\PhotoController@destroy');

        // drawings
        Route::get('/{option}/drawings', 'Option\DrawingController@index');
        Route::post('/{option}/drawings', 'Option\DrawingController@create');
        Route::delete('/{option}/drawings/{media}', 'Option\DrawingController@destroy');
        Route::get('/{option}/drawings/{media}', 'Drawing\TagController@drawingTags');



            // wizard_image
            Route::get('/{option}/wizard_image', [WizardImageController::class, 'form'])
                ->name('option.wizard_image.form');

            Route::post('/{option}/wizard_image', [WizardImageController::class, 'set'])
                ->name('option.wizard_image.set');

            Route::delete('/{option}/wizard_image', [WizardImageController::class, 'delete'])
                ->name('option.wizard_image.delete');







            Route::get('/{option}/pricing', 'Option\PricingController@form')
                ->name('option.pricing.form');
            Route::post('/{option}/pricing', 'Option\RevisionController@revisionFromPricing')
                ->name('option_revision_from_pricing');





//
//
//            Route::group(['prefix' => 'basevan/{basevan}'], function () {
//
//
//
//        });





    });


    Route::group(['prefix' => 'media'], function () {
        Route::delete('/{media}', "MediaController@destroy");

        Route::delete('/{media}/tag/{tag}',    "Drawing\TagController@delete");
        Route::post('/{media}/tag/{tag}',    "Drawing\TagController@create");

    });


});
//Route::redirect('/', '/homepage');
//
//	Route::group(['prefix' => 'public'], function () {
//		Route::get('/', 'PublicController@showBaseVans');
//		Route::get('/{basevan}', 'PublicController@showOptions');
//		Route::get('option/{option}', 'PublicController@showComponents');
//		Route::get('whereUsed/{stock_code}/{format?}', 'PublicController@showWhereUsed');
//
//	});
//
//
//
//// Authentication Routes...
//Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
//Route::post('login', 'Auth\LoginController@login');
//Route::post('logout', 'Auth\LoginController@logout')->name('logout');
//
//
//
//Route::group(['middleware'=>['auth']], function(){
//
//	Route::get('preferences', "UserController@preferences");
//	Route::patch('preferences/{user}', "UserController@savePreferences");
//
//
//	Route::resource('basevan','BaseVanController');
//

//
//
//
//
//
//	Route::get('/l/{basevan}/{form}/{formElement}', "FormElementController@options");
//
//
//
//
//	Route::group(['prefix' => 'basevan/{basevan}'], function () {
//
//		// TEMPLATES
//		Route::group(['prefix' => 'templates'], function () {
//			Route::get('/', "TemplateController@index");
//			Route::get('create', "TemplateController@create");
//			Route::post('/', "TemplateController@store");
//			Route::get('{template}/edit', "TemplateController@edit");
//
//
//			Route::get('reorder', "TemplateController@reorder");
//			Route::post('reorder', "TemplateController@storeReorder");
//
//
//			Route::patch('{template}', "TemplateController@update");
//
//            Route::get('{template}/options', "TemplateController@templateOptions");
//            Route::get('{template}/cleanView', "TemplateController@cleanTemplateOptionsView");
//			Route::post('{template}/options', "TemplateController@storeTemplateOptions");
//			Route::get('{template}/clone', "TemplateController@clone");
//
//		});
//
//		// FORMS
//
//		Route::group(['prefix' => 'forms'], function () {
//
//			// reorder forms, not elements
//			Route::get('reorder', "FormController@reorder");
//			Route::post('reorder', "FormController@storeReorder");
//			// end form reordering
//
//			Route::get('/create', "FormController@create");
//			Route::post('/', "FormController@store");
//
//			Route::get('/', "FormController@index");
//
//			Route::get('/{form}', "FormController@show");
//
//			// reorder form elements
//			Route::get('/{form}/reorder', "FormElementController@reorder");
//			Route::post('/{form}/reorder', "FormElementController@submitReorder");
//
//
//
//
//			Route::group(['prefix' => '{form}/element'], function () {
//
//			//	Route::post('/reorder', "FormElementController@reorder");
//				Route::get('/create', "FormElementController@create");
//				Route::post('/', "FormElementController@store");
//
//
//
//				Route::group(['prefix' => '{formElement}'], function () {
//					Route::get('edit', "FormElementController@edit");
//					Route::get('delete', "FormElementController@delete");
//					Route::patch('/', "FormElementController@update");
//
//
//					// reorder the items in a form element
//					Route::get('reorder', "FormElementItemController@reorder");
//					Route::post('reorder', "FormElementItemController@submitReorder");
//
//					Route::get('items/{item}/delete', "FormElementItemController@delete");
//					Route::get('items/{item}/edit', "FormElementItemController@edit");
//					Route::post('items/{item}', "FormElementItemController@update");
//					Route::get('items/create', "FormElementItemController@create");
//					Route::post('items', "FormElementItemController@store");
//
//
//					// form element rule
//					Route::get('rule', "FormElementRuleController@show");
//					Route::post('rule', "FormElementRuleController@store");
//
//					Route::get('options', "FormElementController@options");
//					Route::post('options', "FormElementController@updateOptions");
//
//					Route::get('images', "FormElementController@images");
//					Route::post('images', "FormElementController@updateImages");
//				});
//			});
//
//		});
//
//
//
//
//		// LAYOUTS
//		Route::group(['prefix' => 'layouts'], function () {
//			Route::get('{layout}/media', "LayoutController@addMedia");
//			Route::get('/', "LayoutController@index");
//			Route::get('create', "LayoutController@create");
//			Route::get('{layout}', "LayoutController@show");
//			Route::post('/', "LayoutController@store");
//			Route::get('{layout}/edit', "LayoutController@edit");
//			Route::patch('{layout}', "LayoutController@update");
//		});
//	});
//
////	Route::group(['prefix' => 'layout/{layout}/component'], function () {
////		Route::get('create', "LayoutOptionController@create");
////		Route::post('/', "LayoutOptionController@store");
////		Route::get('{layoutoption}/edit', "LayoutOptionController@edit");
////		Route::patch('{layoutoption}', "LayoutOptionController@update");
////		Route::delete('{layoutoption}', "LayoutOptionController@destroy");
////	});
//
//
//





//
//
//    });
//
//	    Route::resource('component', 'ComponentController');
//
//        Route::get('syspro/search', "ComponentController@search");
//        Route::post('syspro/search', "ComponentController@search");
//
//
//
//    Route::group(['prefix' => 'questions'], function () {
//		Route::get('{question?}', "QuestionController@index");
//		Route::get('{id}/create', "QuestionController@create");
//		Route::post('/', "QuestionController@store");
//		Route::get('{question}/edit',	"QuestionController@edit");
//		Route::patch('{question}', "QuestionController@update");
//		Route::delete('/{question}', 'QuestionController@destroy');
//	});
//
//
//

//
//
//
//
//
//
//
//
//
//	//SEARCH
//	Route::get('search/components',"SearchController@searchComponentsForm");
//	Route::post('search/components',"SearchController@searchComponents");
//
//    Route::get('search/phantoms',"SearchController@searchPhantomsForm");
//    Route::post('search/phantoms',"SearchController@searchPhantoms");
//
//
//
//    // PUBLIC
//	Route::group(['prefix' => 'sales/{basevan}'], function () {
//
//		Route::get('pricelist', "PriceListController@pricelist");
//		Route::get('priceListWithoutOffset', "PriceListController@priceListWithoutOffset");
//
//		Route::get('option/{option}/pricing', "PriceListController@optionPricingForm");
//		Route::patch('option/{option}/pricing', "PriceListController@savePricing");
//
//	});
//
//
//
//
//});
//
//
//// PUBLIC
//Route::group(['prefix' => 'inventory'], function () {
//
//	// main option routes
//	Route::get( '/onorder/{dept?}/{column?}/{order?}', 'SysproOrderController@onorder' );
//	Route::get( '/recentdeliveries/{dept?}/{column?}/{order?}', 'SysproOrderController@recentdeliveries' );
//	Route::get( '/openPartsBuildOrders/{dept?}', 'SysproOrderController@openPartsBuildOrders' );
//	Route::get( '/finishedGoods', 'SysproOrderController@finishedGoods' );
//
//
//	Route::group(['prefix' => 'kanban'], function () {
//		Route::get('test', "KanbanCardController@test");
//		Route::get('form', "KanbanCardController@form");
//		Route::post('form', "KanbanCardController@render");
//	});
//
//
//
//    Route::get('myles/{offset}/{limit}', 'Option\PhotoController@migrate');
//
//
//
//});
//

	/**
	 * ALbums
	 */
	Route::group(['prefix' => 'albums'], function () {
        Route::post('/moveAlbum', "AlbumController@moveAlbum");

        Route::get('{album}/create', "AlbumController@create");
		Route::get('{album}', "AlbumController@show");
        Route::patch('{album}', "AlbumController@update");
        Route::delete('{album}', 'AlbumController@destroy');
        Route::post('{album}/add', "AlbumController@add");
        Route::delete('{album}/{media}/delete', "AlbumController@deletePhoto");
		Route::get('{album}/edit',	"AlbumController@edit");
		Route::get('/{album}/move', "AlbumController@moveForm");
		Route::post('/move', "AlbumController@move");
        Route::post('/', "AlbumController@store");
	});


Route::group(['prefix' => 'folders'], function () {
    Route::get( '/{folder?}', "Folders\FolderController@show");
    Route::post( '/{folder}/create', "Folders\FolderController@store");
    Route::post( '/{folder}', "Folders\FileController@store");
    Route::delete( '/{folder}/delete', "Folders\FolderController@delete");
});

Route::delete( '/files/{media}/delete', "Folders\FileController@delete");
