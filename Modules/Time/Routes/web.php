<?php

use Illuminate\Support\Facades\Route;
use Modules\Time\Http\Controllers\HomeController;
use Modules\Time\Http\Controllers\LoginController;

Route::group([
    'prefix'=>'time',
    'name' => 'time.'
], function() {

    // select a letter to filter staff accounts
    Route::get('/letter/{letter}', [LoginController::class, 'letter'])
        ->name('letter');

    // show a keypad for the user
    Route::get('/keypad/{user}', [LoginController::class, 'keypad'])
        ->name('keypad');

    // submit the login form for evaluation
    Route::post('/submitLogin', [LoginController::class, 'submitLogin'])
        ->name('submitLogin');

    // start the login process
    Route::get('/', [LoginController::class, 'login']);

    Route::match(['GET','POST'],'/logout', [HomeController::class, 'logout']);

});


Route::group([
    'middleware' => 'auth',
    'prefix'=>'time',
    'name' => 'time.'
], function() {
    Route::post('/clockIn', 'HomeController@clockIn')->name('clockIn');

    Route::get('/home', 'HomeController@home')->name('home');
    Route::get('/fetchAvailableJobs/{prefix}', 'HomeController@fetchAvailableJobs')->name('fetchAvailableJobs');

    Route::match(['GET','POST'],'/logout', [HomeController::class, 'logout']);

});
