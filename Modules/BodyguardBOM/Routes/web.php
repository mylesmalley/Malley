<?php

use Modules\BodyguardBOM\Http\Controllers\Categories\CategoriesController;
use Modules\BodyguardBOM\Http\Controllers\Kits\CreateController;
use Modules\BodyguardBOM\Http\Controllers\Kits\ShowController;
use Modules\BodyguardBOM\Http\Controllers\Kits\PartCategoriesController;
use Modules\BodyguardBOM\Http\Controllers\Kits\IndexController;

Route::prefix('bodyguardbom')->group(function() {

    Route::get('/', [IndexController::class, 'show'])
        ->name('bg.kits.home');


//
//    Route::prefix('category')->group(function() {
//
//        Route::get('/{bg_category?}', [ CategoriesController::class, 'show' ])
//        ->name('bg.categories.show');
//
//        Route::post("/create", [ CategoriesController::class, 'store'])
//            ->name('bg.categories.store');
//
//        Route::get("/{bg_category}/edit", [ CategoriesController::class, 'edit'])
//            ->name('bg.categories.edit');
//
//        Route::patch("/", [ CategoriesController::class, 'update'])
//            ->name('bg.categories.update');
//
//        Route::delete("/delete", [ CategoriesController::class, 'delete'])
//            ->name('bg.categories.delete');
//
//    });

    Route::prefix('kits')->group(function() {

        Route::get("/create/{bg_category?}", [ CreateController::class, 'create'])
            ->name('bg.kits.create');

        Route::post("/", [ CreateController::class, 'store'])
            ->name('bg.kits.store');



//        Route::post("/add_to_category", [ PartCategoriesController::class, 'store'])
//            ->name('bg.parts.categories.store');
//
//        Route::delete("/remove_from_category", [ PartCategoriesController::class, 'delete'])
//            ->name('bg.parts.categories.remove');
//
//        Route::get("/{bg_part}/add_to_category", [ PartCategoriesController::class, 'create'])
//            ->name('bg.parts.categories.add');

        Route::get("/{bg_part}", [ ShowController::class, 'show'])
            ->name('bg.kits.show');


    });



});
