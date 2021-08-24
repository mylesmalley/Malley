<?php


use Illuminate\Support\Facades\Route;
use Modules\Blueprint\Http\Controllers\HomeController;
use Modules\Blueprint\Http\Controllers\Blueprint\HomeController as BlueprintHome;
use Modules\Blueprint\Http\Controllers\Wizard\WizardController;
use Modules\Blueprint\Http\Controllers\Blueprint\ConfigurationController;

Route::domain( config('malley.external_domain') )->group(function() {
    Route::middleware(['auth'])->group( function(){

    Route::prefix('blueprint')->group(function() {

        // My Blueprint Home Page
        Route::get('my_blueprints/{user?}', [ HomeController::class, 'my_blueprints' ])
            ->name('my_blueprints');

        // My Blueprint Home Page
        Route::get('create', [ HomeController::class, 'my_blueprints' ])
            ->name('blueprint.create');




            Route::prefix('{blueprint}')->group(function() {

                /**
                 * Handling Wizards
                 */
                Route::get('wizard/{wizard}', [WizardController::class, 'show'])
                    ->name('blueprint.wizard');

                Route::post('wizard/{wizard}', [WizardController::class, 'process'])
                    ->name('blueprint.wizard.submit');


                /**
                 * Configuration Stuff
                 */
                Route::get('/configuration', [ConfigurationController::class, 'show'])
                    ->name('blueprint.configuration');




                // home page for individual blueprints
                Route::get('/', [ BlueprintHome::class, 'show' ])
                    ->name('blueprint.home');
            }); // individual blueprint routes


        }); // end blueprint routes
    }); // end middleware
}); // end domain


//
//Route::domain(env('INTERNAL_DOMAIN', 'index.localhost') )->group(function() {
//    Route::prefix('blueprint')->group(function() {
//        Route::get('/', [BlueprintController::class , 'private_index']);
//    });
//});

