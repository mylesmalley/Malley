<?php

use Modules\Labour\Http\Controllers\ClockInController;
use Modules\Labour\Http\Controllers\ClockOutController;
use Modules\Labour\Http\Controllers\FlagController;
use Modules\Labour\Http\Controllers\HomeController;
use Modules\Labour\Http\Controllers\LoginController;
use Modules\Labour\Http\Controllers\Reports\ClockedInUsersController;
use Modules\Labour\Http\Controllers\ManageLabourController;
use Modules\Labour\Http\Controllers\Reports\LabourOnJobReportController;


Route::prefix('labour')->group(function() {

    // regular auth process
    Route::middleware('auth')->group( function(){

        /**
         * ROUTES FOR MANAGING LABOUR
         */
        Route::prefix('management')->group(function() {
            Route::get('', [ ManageLabourController::class, 'home' ])
                ->name('labour.management.home');
        });

        /**
         * ROUTES FOR REPORTS
         */
        Route::prefix('reports')->group(function() {
            Route::get('clocked_in_users', [ ClockedInUsersController::class, 'clocked_in' ])
                ->name('labour.reports.clocked_in');

            Route::get('labour_on_job/{job?}', [ LabourOnJobReportController::class, 'show' ])
                ->name('labour.reports.labour_on_job');
        });


    });


    /**
     *  LABOUR TRACKING FOR REGULAR USERS
     */
    Route::middleware('labourAuth')->group( function(){
        Route::get('/home', [ HomeController::class, 'home' ])
            ->name('labour.home');

        Route::post('/clock_in', [ClockInController::class, 'clock_in'])
            ->name('labour.clock_in');

        Route::patch('/clock_out', [ClockOutController::class, 'clock_out'])
            ->name('labour.clock_out');

        Route::patch('/flag', [FlagController::class, 'toggleFlag'])
            ->name('labour.flag');

        Route::post('/logout', [LoginController::class, 'logout'])
            ->name('labour.logout');
    });


    Route::get("/alphabet", [LoginController::class, "alphabet"])
        ->name("labour.login.alphabet");
    Route::get("/letter/{letter}", [LoginController::class, "letter"])
        ->name("labour.login.letter");
    Route::get("/user/{user?}", [LoginController::class, "user"])
        ->name("labour.login.user_form");

//
//    Route::get('/{user?}', [ LoginController::class, 'loginForm' ])
//        ->name('labour.login');
    Route::post('/login', [ LoginController::class, 'submitLogin' ])
        ->name('labour.submitLogin');








});
