<?php



use Illuminate\Support\Facades\Route;

Route::prefix('questionnaire')->group(function() {
    Route::get('/{wizard}/graph', 'QuestionnaireController@graph');

    Route::get('/{wizard}/{blueprint}', 'QuestionnaireController@show');

    Route::post('addAction', [QuestionnaireControoler::class, 'addAction'])
        ->name('wizard.add_action');
});
