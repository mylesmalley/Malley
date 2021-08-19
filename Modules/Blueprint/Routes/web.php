<?php


use Illuminate\Support\Facades\Route;
use Modules\Blueprint\Http\Controllers\BlueprintController;
use Modules\Blueprint\Http\Controllers\HomeController;

Route::domain( env( "EXTERNAL_DOMAIN",  'blueprint.localhost' ) )->group(function() {
    Route::prefix('blueprint')->group(function() {
   //     Route::get('/', [BlueprintController::class , 'public_index']);


        // My Blueprint Home Page
        Route::get('my_blueprints', [ HomeController::class, 'my_blueprints' ])
            ->name('my_blueprints');




    });
});

Route::domain(env('INTERNAL_DOMAIN', 'index.localhost') )->group(function() {
    Route::prefix('blueprint')->group(function() {
        Route::get('/', [BlueprintController::class , 'private_index']);
    });
});

