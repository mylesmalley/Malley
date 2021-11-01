<?php

// Dashboard stuff
use Illuminate\Support\Facades\Route;
use Modules\Vehicles\Http\Controllers\DatesController;
use Modules\Vehicles\Http\Controllers\Documents\StickerController;
use Modules\Vehicles\Http\Controllers\InspectionReports\InspectionReportController;
use Modules\Vehicles\Http\Controllers\Reporting\FordMilestoneComplianceReport;
use Modules\Vehicles\Http\Controllers\Reporting\PendingFordMilestoneNotificationsReport;
use Modules\Vehicles\Http\Controllers\Warranty\ClaimController;
use Modules\Vehicles\Http\Controllers\Warranty\WorkOrderFromWarrantyClaimController;


Route::group(['prefix'=>'vehicles'], function () {

    Route::group(['prefix'=>'dashboard','namespace'=>'Dashboard'], function () {
        // hoome page
        Route::get('', "IndexController@show");
    });


//    Route::get('/mgt', [DatesController::class, 'migrate'])
//        ->name('vehicles.migrate_date');
//


    Route::get('/inspections',    [InspectionReportController::class, "inspectionReportForm" ])
        ->name('inspection.report');

    Route::get('/inspectionsFocused',    [InspectionReportController::class, "focusedReport" ])
        ->name('inspection.focused.report');

    Route::post('/inspections',    [InspectionReportController::class, "inspectionReportForm" ])
        ->name('inspection.report.post');

    Route::get('/inspectionsFPG',    [InspectionReportController::class, "fullPageGraphs" ])
        ->name('inspection.fullPageGraphs');






    Route::get('/reports/ford_compliance',    [FordMilestoneComplianceReport::class, "view" ])
        ->name('vehicles.reports.ford_compliance');

    Route::get('/reports/pending_ford_milestones',    [PendingFordMilestoneNotificationsReport::class, "view" ])
        ->name('vehicles.reports.pending_ford_milestones');



    // giant spreadsheet
    Route::get('/all',"VehiclesController@all");


    // merging vehicles
    Route::get('/compare/{a}/{b}',"MergeController@compare");
    Route::get('/moveFiles/{a}/{b}',"MergeController@moveFiles");
    Route::get('/moveAlbums/{a}/{b}',"MergeController@moveAlbums");
    Route::get('/moveDates/{a}/{b}',"MergeController@moveDates");
    Route::get('/moveField/{a}/{b}/{field}',"MergeController@moveField");
    Route::get('/markForDeletion/{vehicle}',    "MergeController@markForDeletion");


 //   Route::get('/batches',    "BatchImporter@batch_files");
 //   Route::post('/batches',    "BatchImporter@store_files");


    /**
    *  DEALERS
    */
    Route::get('/dealers',    "DealerController@index");
    Route::get('/dealers/create',    "DealerController@create");
    Route::post('/dealers',    "DealerController@store");
    Route::get('/dealers/{company}',    "DealerController@edit");
    Route::patch('/dealers/{company}',    "DealerController@update");





    Route::get('/search',    "SearchController@search");
    Route::post('/search',    "SearchController@search");


    Route::get('/category/{category}/{category2?}/{title?}',      "IndexController@category" );
    Route::get('/',                         "IndexController@index" );

    Route::get('/calendar/{title}',  "CalendarController@show");
    Route::post('/calendar/{title}',  "CalendarController@get");



    // edit and update a calendar date
    //Route::get('/dates/{vehicleDate}',    "VehicleCalendarController@edit");
    //Route::post('/dates/{vehicleDate}',    "VehicleCalendarController@update");
    //

    Route::get('reports/productionBuildList', "ReportsController@productionBuildListReport");
    Route::get('reports/transitionReport/{year?}', "ReportsController@transitionReport");
    Route::get('reports/USChassisInCanadaReport', "ReportsController@USChassisInCanadaReport");
    Route::get('reports/atThorntonOrYork', "ReportsController@atThorntonOrYork");




    // create and look at a vehicle
    Route::get('create',    "VehiclesController@create");
    Route::post('',         "VehiclesController@store");
    Route::get('/{vehicle}',    "VehiclesController@show")->name('vehicle.home');


    // vehicle serials
    Route::get('/{vehicle}/serials',    "SerialsController@edit");
    Route::patch('/{vehicle}/serials',    "SerialsController@update");


    Route::get('/warrantyclaim/index',
        [ClaimController::class, "index" ])
        ->name('warranty_claim_index');

    // create a work order from a warranty claim
    Route::get('/warrantyclaim/{warrantyClaim}',
        [WorkOrderFromWarrantyClaimController::class, "create" ])
        ->name('workOrderFromWarrantyClaim');

    // vehicle warranty and customer
    // quick create form for warranties
    Route::get('/{vehicle}/warrantyclaim',    "Warranty\CreateController@create");
    Route::post('/{vehicle}/warrantyclaim',    "Warranty\CreateController@store");


    Route::get('/{vehicle}/warrantyAndCustomer',    "WarrantyAndCustomerController@edit");
    Route::patch('/{vehicle}/warrantyAndCustomer',    "WarrantyAndCustomerController@update");
    Route::get('/{vehicle}/warrantyToggle',    "WarrantyAndCustomerController@warrantyToggle");
    Route::get('/{vehicle}/warrantyCard/{bi?}',    "WarrantyAndCustomerController@warrantyCard");

    Route::get('/{vehicle}/warrantyClaim/{warrantyClaim}',    "Warranty\ClaimController@show");
    Route::patch('/{vehicle}/warrantyClaim/{warrantyClaim}',    "Warranty\ClaimController@update");



//    // vehicle dates
//    Route::get('/{vehicle}/dates',    "DatesController@edit");
//    Route::patch('/{vehicle}/dates',    "DatesController@update");
//

    /**
     * vehicle dates
     */
    Route::get('/{vehicle}/dates', [DatesController::class, 'show' ])
        ->name('vehicle.dates');

    Route::get('/{vehicle}/dates/{vehicleDate}', [DatesController::class, 'edit' ])
        ->name('vehicle.date.edit');

    Route::get('/{vehicle}/deleteDate/{vehicleDate}', [DatesController::class, 'delete' ])
        ->name('vehicle.date.delete');

    Route::post('/{vehicle}/dates/{vehicleDate}', [DatesController::class, 'update' ])
        ->name('vehicle.date.update');

    Route::post('/{vehicle}/storedate', [DatesController::class, 'store' ])
        ->name('vehicle.date.store');




    // vehicle ALBUMS
    Route::get('/{vehicle}/albums',    "AlbumController@show");
    Route::post('/{vehicle}/albums',    "AlbumController@store");
    Route::delete('/{vehicle}/albums/{albumID}',    "AlbumController@delete");



    // edit a vehicle
    Route::get('/{vehicle}/edit',    "VehiclesController@edit");
    Route::patch('/{vehicle}',    "VehiclesController@update");


    Route::get('/{vehicle}/regulatory',    "VehiclesController@editRegulatory");
    Route::patch('/{vehicle}/regulatory',    "VehiclesController@updateRegulatory");






    // get a vehicle's dates
    Route::post('/{vehicle}/dates',    "VehicleCalendarController@get");

    // adding new dates
    Route::get('/{vehicle}/date',    "VehicleCalendarController@create");
    Route::post('/{vehicle}/date',    "VehicleCalendarController@store");

    // FILES
    Route::get('/{vehicle}/files',    "FilesController@show");
    Route::post('/{vehicle}/files',    "FilesController@store");
    Route::delete('/{vehicle}/media/{media}',    "FilesController@delete");


    // Bill of Materials
    Route::get('/{vehicle}/bom',    "BOMController@show");




    // Inspections
    Route::get('/{vehicle}/inspections',    "InspectionController@show");
    Route::post('/{vehicle}/inspections',    "InspectionController@store");
    Route::get('/{vehicle}/inspections/{inspection}',"InspectionController@edit");
    Route::patch('/{vehicle}/inspections/{inspection}',"InspectionController@update");
    Route::delete('/{vehicle}/inspections/{inspection}',"InspectionController@delete");


    /**
    * DOCUMENT GENERATION
    */

    //Route::get('{vehicle}/documents/test', "Documents\TestController@show");
    Route::get('{vehicle}/documents/pdiTransit', "Documents\PDIController@transit");
    Route::get('{vehicle}/documents/pdiPromaster', "Documents\PDIController@promaster");


    Route::get('{vehicle}/documents/ProgramAmbulanceDataSummaryForm', "Documents\ProgramAmbulanceDataSummaryController@edit");
    Route::patch('{vehicle}/documents/ProgramAmbulanceDataSummaryForm', "Documents\ProgramAmbulanceDataSummaryController@update");
    Route::get('{vehicle}/documents/ProgramAmbulanceDataSummary', "Documents\ProgramAmbulanceDataSummaryController@show");


    Route::get('{vehicle}/documents/', "Documents\IndexController@show");

    // STICKERS FOR REGULATORY INFO...EXTRA IS FOR US OR CANADIAN VERSION
    Route::get('/{vehicle}/stickers/{extra?}',    [StickerController::class, "show"])
        ->name('vehicle.stickers');





    Route::get('/{vehicle}/tags',    "TagController@vehicleTags");
    Route::delete('/{vehicle}/tag/{tag}',    "TagController@delete");
    Route::post('/{vehicle}/tag/{tag}',    "TagController@create");
    Route::get('/tags/{tag}',    "TagController@show");






});
