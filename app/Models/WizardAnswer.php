<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WizardAnswer extends Model
{
    use HasFactory;

    protected $table = 'wizard_answers';

    public $timestamps = false;

    protected $fillable = [
        'id', // me
        'wizard_question_id', // parent question
        'text', // text of the answer
        'next', // ID of next question
        'wizard_id',
    ];

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(WizardQuestion::class );
    }


    /**
     * @return BelongsTo
     */
    public function nextQuestion(): WizardQuestion
    {
        return WizardQuestion::find( $this->attributes['next']);
    }

    /**
     * @return HasMany
     */
    public function actions(): HasMany
    {
        return $this->hasMany(WizardAction::class );
    }
}
