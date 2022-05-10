<?php

use Modules\BodyguardBOM\Http\Controllers\Categories\CategoriesController;

Route::prefix('bodyguardbom')->group(function() {
    Route::get('/{bg_category?}', [ CategoriesController::class, 'show' ])
        ->name('bg.index.show');

    Route::post("/create", [ CategoriesController::class, 'store'])
        ->name('bg.categories.store');
});
