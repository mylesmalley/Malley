<?php



use Illuminate\Support\Facades\Route;

Route::prefix('questionnaire')->group(function() {
    Route::get('/{wizard}/graph', 'QuestionnaireController@graph');

    Route::get('/{wizard}/{blueprint}', 'QuestionnaireController@show');


});
