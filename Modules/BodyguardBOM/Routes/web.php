<?php

use Modules\BodyguardBOM\Http\Controllers\Categories\CategoriesController;

Route::prefix('bodyguardbom')->group(function() {
    Route::get('/{bg_category?}', [ CategoriesController::class, 'show' ])
        ->name('bg.categories.show');

    Route::post("/create", [ CategoriesController::class, 'store'])
        ->name('bg.categories.store');

    Route::delete("/delete", [ CategoriesController::class, 'delete'])
        ->name('bg.categories.delete');
});
