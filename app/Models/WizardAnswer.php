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
        'position', // added to sort order that answers are shown
    ];

    /**
     * @return BelongsTo
     */
    public function question(): BelongsTo
    {
        return $this->belongsTo(WizardQuestion::class,
            'wizard_question_id');
    }

    /**
     * @return BelongsTo
     */
    public function next_question(): BelongsTo
    {
        return $this->belongsTo(WizardQuestion::class,
            'next');
    }

    /**
     * @return WizardQuestion
     */
    public function nextQuestion(): WizardQuestion
    {
        return WizardQuestion::find($this->attributes['next']);
    }

    /**
     * @return HasMany
     */
    public function actions(): HasMany
    {
        return $this->hasMany(WizardAction::class);
    }
}
