<?php

use Illuminate\Support\Facades\Route;
use Modules\HomePage\Http\Controllers\SearchController;
use Illuminate\Support\Facades\DB;


Route::get('/', 'HomePageController@index');
Route::post('/search', [SearchController::class, 'search']);

Route::get('version', function(){
    $syspro_version = DB::connection('syspro')->table('AdmVersion')->first();

    dd( $syspro_version );
});
