<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\WizardAnswer
 *
 * @property int $id
 * @property string|null $text
 * @property int|null $next
 * @property int $wizard_question_id
 * @property string|null $notes
 * @property int|null $wizard_id
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WizardAction[] $actions
 * @property-read int|null $actions_count
 * @property-read \App\Models\WizardQuestion $question
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer whereNext($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer whereWizardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardAnswer whereWizardQuestionId($value)
 * @mixin \Eloquent
 */
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
