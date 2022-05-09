<?php

use Modules\BodyguardBOM\Http\Controllers\IndexController;

Route::prefix('bodyguardbom')->group(function() {
    Route::get('/{bg_category?}', [ IndexController::class, 'show' ]);
});
