<?php


use Illuminate\Support\Facades\Route;
use Modules\Blueprint\Http\Controllers\BlueprintController;
use Modules\Blueprint\Http\Controllers\HomeController;

Route::domain( config('malley.external_domain') )->group(function() {
    Route::middleware(['auth'])->group( function(){

    Route::prefix('blueprint')->group(function() {
   //     Route::get('/', [BlueprintController::class , 'public_index']);


            // My Blueprint Home Page
            Route::get('my_blueprints/{user?}', [ HomeController::class, 'my_blueprints' ])
                ->name('my_blueprints');


            // My Blueprint Home Page
            Route::get('create', [ HomeController::class, 'my_blueprints' ])
                ->name('blueprint_create');



        }); // end prefix
    }); // end middleware
}); // end domain


//
//Route::domain(env('INTERNAL_DOMAIN', 'index.localhost') )->group(function() {
//    Route::prefix('blueprint')->group(function() {
//        Route::get('/', [BlueprintController::class , 'private_index']);
//    });
//});

