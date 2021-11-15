<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Wizard
 *
 * @property int $id
 * @property string $name
 * @property int|null $start
 * @property-read Collection|WizardQuestion[] $questions
 * @property-read int|null $questions_count
 * @method static Builder|Wizard newModelQuery()
 * @method static Builder|Wizard newQuery()
 * @method static Builder|Wizard query()
 * @method static Builder|Wizard whereId($value)
 * @method static Builder|Wizard whereName($value)
 * @method static Builder|Wizard whereStart($value)
 * @mixin Eloquent
 * @property int|null $end
 * @property string|null $start_notes
 * @property string|null $end_notes
 * @property string|null $completed_form_option
 * @method static Builder|Wizard whereCompletedFormOption($value)
 * @method static Builder|Wizard whereEnd($value)
 * @method static Builder|Wizard whereEndNotes($value)
 * @method static Builder|Wizard whereStartNotes($value)
 */
class Wizard extends Model
{
    use HasFactory;

    protected $table = 'wizards';

    protected  $fillable = [
        'id',
        'name',
        'start', // id of first question
        'end', // id of last question

        'start_notes', // instructions or whatever
        'end_notes', // what do now?
        'base_van_id', // platform
        'completed_form_option', // option that gets triggered when the wizard is complete
    ];

    public $timestamps = false;

    /**
     * @return HasMany
     */
    public function questions(): HasMany
    {
        return $this->hasMany(WizardQuestion::class );
    }


    /**
     * @return WizardQuestion
     */
    public function startWizard(): WizardQuestion
    {
        return WizardQuestion::find( $this->attributes['start']);
    }

}
