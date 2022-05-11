<?php

use Modules\BodyguardBOM\Http\Controllers\Categories\CategoriesController;
use Modules\BodyguardBOM\Http\Controllers\Parts\CreateController;
use Modules\BodyguardBOM\Http\Controllers\Parts\ShowController;
use Modules\BodyguardBOM\Http\Controllers\Parts\PartCategoriesController;

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

        Route::get("/create/{bg_category?}", [ CreateController::class, 'create'])
            ->name('bg.parts.create');

        Route::post("/", [ CreateController::class, 'store'])
            ->name('bg.parts.store');

        Route::get("/{bg_part}", [ ShowController::class, 'show'])
            ->name('bg.parts.show');

        Route::get("/{bg_part}/add_to_category", [ PartCategoriesController::class, 'create'])
            ->name('bg.parts.categories.add');

        Route::post("/add_to_category", [ PartCategoriesController::class, 'store'])
            ->name('bg.parts.categories.store');

    });



});
