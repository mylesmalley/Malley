<?php

use Illuminate\Support\Facades\Route;

Route::prefix('announcement')->group(function() {
    Route::get('/photo', 'AnnouncementController@photo')->name('announcement.photo');
    Route::get('/text', 'AnnouncementController@text')->name('announcement.text');
    Route::get('/test', 'AnnouncementController@test')->name('announcement.test');
    Route::get('/', 'AnnouncementController@show')->name('announcement.random');

//    Route::middleware('auth')->group( function(){
//        Route::get('/all', 'AnnouncementController@index');
//    });
});
