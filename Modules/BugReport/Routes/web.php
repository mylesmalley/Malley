<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


use Illuminate\Support\Facades\Route;

//Route::domain( 'blueprint.malleyindustries.com' )->group( function () {
//        Route::get( 'create', "BugReportController@create");
//
//        Route::get( 'thankyou/{url?}', "BugReportController@thankyou");
//        Route::post( '', "BugReportController@store");
//    });

	//Route::domain( 'index.malleyindustries.com' )->group( function () {
	    Route::group(['prefix'=>'bugs'], function(){

        Route::get( 'user/{user}', "UserController@show");


        Route::get( 'all/engineering', "IndexController@openEngineering");
        Route::get( 'all/blueprint', "IndexController@openBlueprint");
        Route::get( 'all/unassigned', "IndexController@unassigned");
        Route::get( 'all/open', "IndexController@open");
            Route::get( 'all', "IndexController@index");
            Route::get( '/', "IndexController@index");



        Route::get( 'engineering', "EngineeringController@create");
        Route::post( 'engineering', "EngineeringController@store");

        Route::patch( '{bug}/activities', "ActivityController@update");

        Route::patch('/inlineUpdate', "ActivityController@inlineUpdate");



        Route::patch( '{bug}', "UpdateBugReportController@update");

        Route::post( '{bug}', "UpdateBugReportController@update");
        Route::get( '{bug}/{mode?}', "BugReportController@show");


        });


   // });


