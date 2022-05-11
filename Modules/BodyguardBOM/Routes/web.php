<?php

use Modules\BodyguardBOM\Http\Controllers\Categories\CategoriesController;
use Modules\BodyguardBOM\Http\Controllers\Parts\CreateController;

Route::prefix('bodyguardbom')->group(function() {

    Route::prefix('category')->group(function() {

        Route::get('/{bg_category?}', [ CategoriesController::class, 'show' ])
        ->name('bg.categories.show');

        Route::post("/create", [ CategoriesController::class, 'store'])
            ->name('bg.categories.store');

        Route::get("/{bg_category}/edit", [ CategoriesController::class, 'edit'])
            ->name('bg.categories.edit');

        Route::patch("/", [ CategoriesController::class, 'update'])
            ->name('bg.categories.update');

        Route::delete("/delete", [ CategoriesController::class, 'delete'])
            ->name('bg.categories.delete');

    });

    Route::prefix('parts')->group(function() {

        Route::get("/create", [ CreateController::class, 'create'])
            ->name('bg.parts.create');
        Route::post("/", [ CreateController::class, 'store'])
            ->name('bg.parts.store');
    });



});
