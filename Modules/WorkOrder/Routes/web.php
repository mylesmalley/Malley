<?php

use Illuminate\Support\Facades\Route;



Route::group(['prefix'=>'workOrders'], function () {


    Route::post('', 'WorkOrderController@create');


// edit line
    Route::patch('line/{workOrderLine}', 'LineController@update');
    Route::delete('line/{workOrderLine}', 'LineController@destroy');
// add line
    Route::post('line', 'LineController@store');


    Route::get('test', 'TestController@test');
    Route::get('{workOrder}/render', 'RenderController@show');

    Route::get('{workOrder}/{mode}/{value?}', 'WorkOrderController@show');

// change details sections
    Route::patch('{workOrder}/vehicleDetails', "DetailsController@updateVehicleDetails");
    Route::patch('{workOrder}/details', "DetailsController@updateOrderDetails");
    Route::patch('{workOrder}/customer', "DetailsController@updateCustomer");
    Route::patch('{workOrder}/formatting', "DetailsController@updateFormatting");


});
//Route::get('{workOrder}/{mode}', 'WorkOrderController@show');
//Route::get('{workOrder}', 'WorkOrderController@show');
