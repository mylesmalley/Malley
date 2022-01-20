<?php

use Illuminate\Support\Facades\Route;
use Modules\Syspro\Http\Controllers\Inventory\CountController;
use Modules\Syspro\Http\Controllers\Inventory\HomeController;
use Modules\Syspro\Http\Controllers\InventoryItems\CreateController;
use Modules\Syspro\Http\Controllers\InventoryItems\ShowController;
use Modules\Syspro\Http\Controllers\InventoryItems\TicketController;


Route::group( ['prefix' => 'syspro'],  function () {

    // vin report
    Route::get('VINReport', "VINReportController@show");

    // MDEL Report Trial
    Route::get('MDELReport', "MDELReportController@show");


    Route::get('JobCostChecker', "JobCostCheckerController@show");
    Route::get('JobTrialKit', "JobTrialKitController@show")->name('JobTrialKit');

    Route::get('BOMCoster/{stockCode?}', "BOMCosterController@show");




    /**
     *  ALL ROUTES IN THIS FILE ARE PREFIXED BY /syspro/
     */
    Route::get("/vinreport", "Syspro\VINReportController@show");


    // inventory search
    Route::get('inventoryQuery/search', "Syspro\InventoryQueryController@search");
    Route::post('inventoryQuery/search', "Syspro\InventoryQueryController@search");

    // inventory query
    Route::get('inventoryQuery/', "Syspro\InventoryQueryController@show");
    Route::get('inventoryQuery/{code}', "Syspro\InventoryQueryController@get")->name('stock_code_query');
    Route::post('inventoryQuery', "Syspro\InventoryQueryController@show");








    Route::group([
        'prefix'=>'purchasing',
        'middleware'=>['auth']
    ], function() {
        Route::get('openRequests', "PurchaseRequestController@index")
            ->name('openRequests');

        // creating and storing new requests
        Route::get('newRequest', "PurchaseRequestController@create");
        Route::post('newRequest', "PurchaseRequestController@store");


        // autocomplete of stock codes for order form
        Route::get('search', "PurchaseRequestController@search");

        // editing and closing requests
        Route::get('{purchaseRequest}/editRequest',
            "PurchaseRequestController@edit");
        Route::post('{purchaseRequest}/editRequest',
            "PurchaseRequestController@update");

        Route::delete('{purchaseRequest}/delete',
            "PurchaseRequestController@delete");


    });




    Route::group([
        'prefix'=>'inventory',
        'middleware'=>['auth']
    ], function() {
        Route::group([ 'prefix' => '{inventory}' ], function() {
            // returns the show all form
            Route::get('/all', "InventoryItems\ShowAllController@showAll" );
            Route::get('/allPaginated', "InventoryItems\ShowAllController@showAllPaginated" );

            Route::get('/allNeedingRecount', "InventoryItems\ShowAllController@showNeedsRecount" );
            Route::get('/allNeedingRecountPaginated', "InventoryItems\ShowAllController@sshowNeedsRecountPaginated" );
            Route::get('/customTickets', "InventoryItems\TicketController@customTicketsForm" );
            Route::post('/customTickets', "InventoryItems\TicketController@customTickets" );


            Route::post('/acceptCount', "InventoryItems\ShowController@acceptCount" );
            Route::post('/markAsRecounted', "InventoryItems\ShowController@markAsRecounted" );
            Route::get('/VarianceAcceptanceReport/{group}', "InventoryItems\VarianceAcceptanceReportController@show" );



            Route::get('/report', "InventoryItems\FilteredReportController@show" );
            Route::post('/tickets', "InventoryItems\TicketController@tickets" );
            Route::post('/ticketsByBin', "InventoryItems\TicketController@ticketsByBin" );


            Route::get('/update_cache', [CountController::class, "update_caches"] )
                ->name('inventory_counts.update_cache');


            // search by stock code
            Route::post('/search',
                "InventoryItems\SearchController@searchWithPost");
            Route::get('/search/{area}/for/{term}/{filter?}',
                "InventoryItems\SearchController@search");
//
//            // search by bin location
//            Route::get('/search/bin/for/{term}',
//                "InventoryItems\SearchController@searchByBin");
//
//            Route::get('/search/group/for/{term}',
//                "InventoryItems\SearchController@searchByGroup");
//            Route::get('/search/locale/for/{term}',
//                "InventoryItems\SearchController@searchByLocale");
//            Route::get('/search/warehouse/for/{term}',
//                "InventoryItems\SearchController@searchByWarehouse");


            // add a new stock code
            Route::get('/items/create',  [CreateController::class, "create"] )
                ->name('inventory_counts.create_custom_item');

            // store new stock code
            Route::post('/items/create', [CreateController::class, "store"] )
                ->name("inventory_counts.store_custom_item" );

            // query an individual stock code
            Route::get('/items/{inventoryItem}', [ShowController::class, "show"] )
                ->name('inventory_count.show_item');

            Route::get('/items/{inventoryItem}/counts/create', "InventoryItemCounts\CreateController@create" );
            Route::post('/items/{inventoryItem}/counts/create', "InventoryItemCounts\CreateController@store" );

            Route::get('/progress', "Inventory\ProgressReportController@show" );

            // the home page for an inventory count
            Route::get('/', [HomeController::class,"home"])
                ->name('inventory_count.home');

        });


        // all invetnory counts
        Route::get('/', "Inventory\CountController@index" );
        // create new inventory count
        Route::get('/create', "Inventory\CountController@create" );
        //store inventory count
        Route::post('/create', "Inventory\CountController@store" );





	// main option routes
	Route::get( '/onorder/{dept?}/{column?}/{order?}', 'SysproOrderController@onorder' );
	Route::get( '/recentdeliveries/{dept?}/{column?}/{order?}', 'SysproOrderController@recentdeliveries' );
	Route::get( '/openPartsBuildOrders/{dept?}', 'SysproOrderController@openPartsBuildOrders' );
	Route::get( '/finishedGoods', 'SysproOrderController@finishedGoods' );


//	Route::group(['prefix' => 'kanban'], function () {
//		Route::get('test', "KanbanCardController@test");
//		Route::get('form', "KanbanCardController@form");
//		Route::post('form', "KanbanCardController@render");
//	});



    });

});
