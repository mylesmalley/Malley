<?php

namespace App\Models;

use Modules\Blueprint\Http\Controllers\Wizard\RedirectFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * App\Models\WizardQuestion
 *
 * @property int $id
 * @property int|null $wizard_id
 * @property string|null $text
 * @property string|null $notes
 * @property string|null $type
 * @property string|null $redirect_method
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WizardAnswer[] $answers
 * @property-read int|null $answers_count
 * @property-read \App\Models\Wizard|null $wizard
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion query()
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion whereNotes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion whereRedirectMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|WizardQuestion whereWizardId($value)
 * @mixin \Eloquent
 */
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
        return $this->hasMany( WizardAnswer::class )
            ->orderBy('position','DESC');
    }







    public function redirect( Collection $selectedAnswers )
    {
        $redirect = $this->attributes['redirect_method'];
        return RedirectFunctions::{$redirect}( $selectedAnswers );
    }
}
