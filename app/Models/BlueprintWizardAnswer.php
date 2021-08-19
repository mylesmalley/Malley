<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\BlueprintWizardAnswer
 *
 * @property int $id
 * @property int|null $blueprint_id
 * @property int|null $wizard_answer_id
 * @property int|null $wizard_question_id
 * @property int|null $wizard_id
 * @property-read \App\Models\WizardAnswer $answer
 * @property-read \App\Models\Blueprint|null $blueprint
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer query()
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer whereWizardAnswerId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer whereWizardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|BlueprintWizardAnswer whereWizardQuestionId($value)
 * @mixin \Eloquent
 */
class BlueprintWizardAnswer extends Model
{
    use HasFactory;

    protected $table = 'blueprint_wizard_answers';

    public $timestamps = false;

    protected $fillable = [
        'id', // self
        'blueprint_id', // parent
        'wizard_answer_id', // the answer
        'wizard_question_id', // the question,
        'wizard_id', // the parent wizard for resetting
    ];


    /**
     * @return BelongsTo
     */
    public function blueprint(): BelongsTo
    {
        return $this->belongsTo(Blueprint::class );
    }

    /**
     * @return BelongsTo
     */
    public function answer(): BelongsTo
    {
        return $this->BelongsTo( WizardAnswer::class );
    }



}
