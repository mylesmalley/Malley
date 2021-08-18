<?php

use Illuminate\Support\Facades\Route;
use Modules\BlueprintBOM\Http\Controllers\BlueprintBOMController;

Route::group(['prefix'=>'blueprintbom'], function() {
    Route::get('/{blueprint}', [BlueprintBOMController::class, 'configuration'] );

    Route::get('/', [BlueprintBOMController::class, 'index'] );
});
