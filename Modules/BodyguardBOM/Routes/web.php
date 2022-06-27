<?php

//use Modules\BodyguardBOM\Http\Controllers\Categories\CategoriesController;
use Modules\BodyguardBOM\Http\Controllers\Kits\CreateController;
use Modules\BodyguardBOM\Http\Controllers\Parts\CreateController as PartsCreateController;
use Modules\BodyguardBOM\Http\Controllers\Parts\IndexController as PartsIndexController;
use Modules\BodyguardBOM\Http\Controllers\Parts\ShowController as PartsShowController;
use Modules\BodyguardBOM\Http\Controllers\Kits\ShowController;
use Modules\BodyguardBOM\Http\Controllers\Kits\ComponentController;
//use Modules\BodyguardBOM\Http\Controllers\Kits\PartCategoriesController;
use Modules\BodyguardBOM\Http\Controllers\Kits\IndexController;

Route::prefix('bodyguardbom')->group(function() {

    Route::get('/', [IndexController::class, 'show'])
        ->name('bg.kits.home');

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


        Route::get("/{bg_kit}/components_from_template",
            [ PartsCreateController::class, 'create_components_from_template'])
            ->name('bg.kits.components_from_template');

        Route::post("/{bg_kit}/components_from_template",
            [ PartsCreateController::class, 'store_bulk_components'])
            ->name('bg.kits.store_bulk_components');



        Route::get("check_if_part_exists",
            [ PartsCreateController::class, 'check_if_part_exists'])
            ->name('bg.kits.check_if_part_exists');





//        Route::post("/add_to_category", [ PartCategoriesController::class, 'store'])
//            ->name('bg.parts.categories.store');
//
//        Route::delete("/remove_from_category", [ PartCategoriesController::class, 'delete'])
//            ->name('bg.parts.categories.remove');
//
//        Route::get("/{bg_part}/add_to_category", [ PartCategoriesController::class, 'create'])
//            ->name('bg.parts.categories.add');

        Route::get("/{bg_kit}", [ ShowController::class, 'show'])
            ->name('bg.kits.show');

        //  does the same as bg.kits.show but redirects after searching for the stock code and assoc id
        Route::get("/{kit_number}/show_by_part_number", [ ShowController::class, 'show_by_part_number'])
            ->name('bg.kits.show_by_part_number');



        Route::get("/{bg_kit}/components",
            [ ComponentController::class, 'show'])
            ->name('bg.kits.components');




        Route::delete("/{bg_kit}/components",
            [ ComponentController::class, 'delete'])
            ->name('bg.kits.components.delete');

        Route::delete("/{bg_kit}/clear_local_stock_codes",
            [ ComponentController::class, 'clear_local_stock_codes'])
            ->name('bg.kits.components.clear_local_stock_codes');

        Route::post("/{bg_kit}/components",
            [ ComponentController::class, 'add'])
            ->name('bg.kits.components.add');


        Route::post("/{bg_kit}/push_to_syspro",
            [ ComponentController::class, 'sync_local_components_to_syspro'])
            ->name('bg.kits.components.push_to_syspro');


        Route::post("/{bg_kit}/import_components",
            [ ComponentController::class, 'import_components_from_syspro_phantom'])
            ->name('bg.kits.components.import');





//
//        Route::post("/{bg_kit}/push_to_syspro", [ ComponentController::class, 'push_to_syspro'])
//            ->name('bg.kits.components.push_to_syspro');



    });



    Route::get('/parts', [PartsIndexController::class, 'show'])
        ->name('bg.parts.home');


    Route::prefix('parts')->group(function() {

        Route::get("/create/{bg_category?}", [ PartsCreateController::class, 'create'])
            ->name('bg.parts.create');

        Route::post("", [ PartsCreateController::class, 'store'])
            ->name('bg.parts.store');



    });



});
