<?php

use Modules\Labour\Http\Controllers\ClockInController;
use Modules\Labour\Http\Controllers\ClockOutController;
use Modules\Labour\Http\Controllers\FlagController;
use Modules\Labour\Http\Controllers\HomeController;
use Modules\Labour\Http\Controllers\LoginController;
use Modules\Labour\Http\Controllers\ManageLabour\EditController;
use Modules\Labour\Http\Controllers\Reports\ClockedInUsersController;
use Modules\Labour\Http\Controllers\ManageLabourController;
use Modules\Labour\Http\Controllers\ManageLabour\HomeController as NewManageLabour;
use Modules\Labour\Http\Controllers\ManageLabour\AddController;
use Modules\Labour\Http\Controllers\Reports\LabourOnJobReportController;


Route::prefix('labour')->group(function() {

    // regular auth process
    Route::middleware('auth')->group( function(){

        /**
         * ROUTES FOR MANAGING LABOUR
         */
        Route::prefix('manage_labour')->group(function() {
            Route::get('new', [ NewManageLabour::class, 'home' ])
                ->name('labour.management.home');

            Route::get('clear_cache/{user_id}/{date}', [ NewManageLabour::class, 'clear_cache' ])
                ->name('labour.management.clear_cache');

            Route::post('add', [ AddController::class, 'add' ])
                ->name('labour.management.add');

            Route::post('edit', [ EditController::class, 'edit' ])
                ->name('labour.management.edit');

            Route::post('clock_out', [ EditController::class, 'clock_out' ])
                ->name('labour.management.clock_out');

            Route::delete('delete', [ EditController::class, 'delete' ])
                ->name('labour.management.delete');

//            Route::get('old', [ ManageLabourController::class, 'home' ])
//                ->name('labour.management.home_old');

        });

        /**
         * ROUTES FOR REPORTS
         */
        Route::prefix('reports')->group(function() {
            Route::get('clocked_in_users', [ ClockedInUsersController::class, 'clocked_in' ])
                ->name('labour.reports.clocked_in');

            Route::get('all_jobs', [ LabourOnJobReportController::class, 'index' ])
                ->name('labour.reports.all_jobs');

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
    Route::get("/user/{user?}", [LoginController::class, "login_form"])
        ->name("labour.login");

//
//    Route::get('/{user?}', [ LoginController::class, 'loginForm' ])
//        ->name('labour.login');
    Route::post('/login', [ LoginController::class, 'submitLogin' ])
        ->name('labour.submitLogin');








});
