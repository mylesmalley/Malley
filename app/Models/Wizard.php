<?php

namespace App\Models;

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
 * @method static \Illuminate\Database\Eloquent\Builder|Wizard newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wizard newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Wizard query()
 * @method static \Illuminate\Database\Eloquent\Builder|Wizard whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wizard whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Wizard whereStart($value)
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
