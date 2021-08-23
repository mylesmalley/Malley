<?php


use Illuminate\Support\Facades\Route;
use Modules\Blueprint\Http\Controllers\HomeController;
use Modules\Blueprint\Http\Controllers\Blueprint\HomeController as BlueprintHome;

Route::domain( config('malley.external_domain') )->group(function() {
    Route::middleware(['auth'])->group( function(){

    Route::prefix('blueprint')->group(function() {

        // My Blueprint Home Page
        Route::get('my_blueprints/{user?}', [ HomeController::class, 'my_blueprints' ])
            ->name('my_blueprints');

        // My Blueprint Home Page
        Route::get('create', [ HomeController::class, 'my_blueprints' ])
            ->name('blueprint_create');

        // home page for individual blueprints
        Route::get('{blueprint}', [ BlueprintHome::class, 'blueprint_home' ])
            ->name('blueprint_home');


        }); // end prefix
    }); // end middleware
}); // end domain


//
//Route::domain(env('INTERNAL_DOMAIN', 'index.localhost') )->group(function() {
//    Route::prefix('blueprint')->group(function() {
//        Route::get('/', [BlueprintController::class , 'private_index']);
//    });
//});

