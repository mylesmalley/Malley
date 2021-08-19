<?php


use Illuminate\Support\Facades\Route;
use Modules\Blueprint\Http\Controllers\BlueprintController;

Route::domain( env( "EXTERNAL_DOMAIN",  'blueprint.localhost' ) )->group(function() {
    Route::prefix('blueprint')->group(function() {
        Route::get('/', [BlueprintController::class , 'public_index']);
    });
});

Route::domain(env('INTERNAL_DOMAIN', 'index.localhost') )->group(function() {
    Route::prefix('blueprint')->group(function() {
        Route::get('/', [BlueprintController::class , 'private_index']);
    });
});

