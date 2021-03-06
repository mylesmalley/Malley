<?php


use Illuminate\Support\Facades\Route;
use Modules\Blueprint\Http\Controllers\Blueprint\CreateController;
use Modules\Blueprint\Http\Controllers\Blueprint\CustomLayoutController;
use Modules\Blueprint\Http\Controllers\Blueprint\DrawingController;
use Modules\Blueprint\Http\Controllers\Blueprint\ExportToSysproController;
use Modules\Blueprint\Http\Controllers\Blueprint\ResetController;
use Modules\Blueprint\Http\Controllers\HomeController;
use Modules\Blueprint\Http\Controllers\Blueprint\HomeController as BlueprintHome;
use Modules\Blueprint\Http\Controllers\Form\FormController;
use Modules\Blueprint\Http\Controllers\Wizard\WizardController;
use Modules\Blueprint\Http\Controllers\Blueprint\ConfigurationController;
//use Modules\Blueprint\Http\Controllers\Blueprint\FloorLayoutController;
use Modules\Blueprint\Http\Controllers\Blueprint\QuoteController;

//Route::domain( config('malley.external_domain') )->group(function() {
    Route::middleware(['auth'])->group( function(){

    Route::prefix('blueprint')->group(function() {
        Route::get('/', function(){
            return redirect()->route('my_blueprints');
        });

        // My Blueprint Home Page
        Route::get('my_blueprints/{user?}', [ HomeController::class, 'my_blueprints' ])
            ->name('my_blueprints');


        // LINK TO CREATE A NEW BLUEPRINT
        Route::get('create/{basevan}', [ CreateController::class, 'create' ])
            ->name('blueprint.create');

        Route::post('create', [ CreateController::class, 'store' ])
            ->name('blueprint.store');



            Route::prefix('{blueprint}')->group(function() {

                /**
                 * Handling Wizards
                 */
                Route::get('wizard/{wizard}', [WizardController::class, 'show'])
                    ->name('blueprint.wizard');

                Route::post('wizard/{wizard}', [WizardController::class, 'process'])
                    ->name('blueprint.wizard.submit');


                /**
                 * Forms
                 */

                Route::get('form/{form}', [FormController::class, 'show'])
                    ->name('blueprint.form');

                Route::post('form', [FormController::class, 'submit'])
                    ->name('blueprint.form.submit');

                Route::post('form/toggle_selection', [FormController::class, 'toggle_selection'])
                    ->name('blueprint.form.toggle_selection');

                Route::post('form/toggle_checkbox', [FormController::class, 'toggle_checkbox'])
                    ->name('blueprint.form.toggle_checkbox');



                Route::get('activeDrawings', [DrawingController::class, 'activeDrawingIDs'])
                    ->name('blueprint.drawings.activeDrawings');

//                Route::get('assemble/{formElement}', [DrawingController::class, 'assemble'])
//                    ->name('blueprint.drawings.assemble');

                Route::get('drawings', [DrawingController::class, 'generateDrawingPackage'])
                    ->name('blueprint.drawings.generate');


                /**
                 * Configuration Stuff
                 */
                Route::get('/configuration', [ConfigurationController::class, 'show'])
                    ->name('blueprint.configuration');


                /**
                 * RESET CONFIGURATION
                 */
                Route::put('/configuration', [ResetController::class, 'reset'])
                    ->name('blueprint.reset');


                /**
                 * SYSPRO DAT FILE
                 */
                Route::get('/syspro_dat', [ExportToSysproController::class, 'exportToSyspro'])
                    ->name('blueprint.syspro_dat');




                /**
                 * FLOOR LAYOUT
                 */
                // show the form, varied by the floor layout and other options
//                Route::get('/floor_layout', [FloorLayoutController::class, 'show'])
//                    ->name('blueprint.floor_layout');
//                // for adding and removing parts, moving them etc. staged changes stored on blueprint model
//                Route::patch('/floor_layout', [FloorLayoutController::class, 'change'])
//                    ->name('blueprint.floor_layout.change');
//


                // show the form, varied by the floor layout and other options
                Route::get('/custom_layout/{name}', [CustomLayoutController::class, 'show'])
                    ->name('blueprint.custom_layout');
                // for adding and removing parts, moving them etc. staged changes stored on blueprint model
                Route::patch('/custom_layout/{name}', [CustomLayoutController::class, 'change'])
                    ->name('blueprint.custom_layout.change');


                Route::post('/custom_layout/{name}', [CustomLayoutController::class, 'store_drawing'])
                    ->name('blueprint.custom_layout.store_drawing');

                // committing staged options to the blueprint configuration.
//                Route::post('/floor_layout', [FloorLayoutController::class, 'store'])
//                    ->name('blueprint.floor_layout.store');



                /**
                 * QUOTATION
                 */
                // show the form, varied by the floor layout and other options
                Route::get('/quotation/create', [QuoteController::class, 'show'])
                    ->name('blueprint.quote');

                Route::get('/quotation/{type?}', [QuoteController::class, 'output_to_pdf'])
                    ->name('blueprint.quote.output_to_pdf');




                /**
                 * HOME PAGE
                 */
                Route::get('/', [ BlueprintHome::class, 'show' ])
                    ->name('blueprint.home');

            }); // individual blueprint routes


        }); // end blueprint routes
    }); // end middleware
//}); // end domain


//
//Route::domain(env('INTERNAL_DOMAIN', 'index.localhost') )->group(function() {
//    Route::prefix('blueprint')->group(function() {
//        Route::get('/', [BlueprintController::class , 'private_index']);
//    });
//});

