<?php

use Modules\Demo\Http\Controllers\DemoController;

use Illuminate\Support\Facades\Route;

Route::prefix('demo')->group(function() {
    Route::get('/graph', 'DemoController@graph');

    Route::get('/', 'DemoController@index');
//    Route::get('wizard/{wizard}/', [Wizard::class, 'show' ]);
    Route::get('question/{wizardQuestion}/', [DemoController::class, 'show' ]);
//    Route::post("answer/{wizardAnswer}", [DemoController::class, 'submit' ]);
    Route::post("answer", [DemoController::class, 'submit' ]);

    Route::get('progress', [DemoController::class, 'progress']);
    Route::get('restart', [DemoController::class, 'restart']);
});
