<?php

namespace App\Models;

use Modules\Questionnaire\Http\Controllers\RedirectFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WizardQuestion extends Model
{
    use HasFactory;

    protected $table = 'wizard_questions';

    public $timestamps = false;

    protected $fillable = [
        'id', // self
        'wizard_id', // parent
        'text', // the question
      //  'type', // type of the question, t/f, pick one, text?
    //    'column', // db column that a text question could update
        'redirect_method',
        'type',
    ];


    /**
     * @return BelongsTo
     */
    public function wizard(): BelongsTo
    {
        return $this->belongsTo(Wizard::class );
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany( WizardAnswer::class );
    }







    public function redirect( Collection $selectedAnswers )
    {
        $redirect = $this->attributes['redirect_method'];

        return RedirectFunctions::{$redirect}( $selectedAnswers );
    }
}
