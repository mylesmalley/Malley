<?php

use Illuminate\Support\Facades\Route;
use Modules\HomePage\Http\Controllers\SearchController;


Route::get('/', 'HomePageController@index');
Route::post('/search', [SearchController::class, 'search']);
