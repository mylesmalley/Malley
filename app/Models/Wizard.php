<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * App\Models\Wizard
 *
 * @property int $id
 * @property string $name
 * @property int|null $start
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\WizardQuestion[] $questions
 * @property-read int|null $questions_count
 * @method static Builder|Wizard newModelQuery()
 * @method static Builder|Wizard newQuery()
 * @method static Builder|Wizard query()
 * @method static Builder|Wizard whereId($value)
 * @method static Builder|Wizard whereName($value)
 * @method static Builder|Wizard whereStart($value)
 * @mixin \Eloquent
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
