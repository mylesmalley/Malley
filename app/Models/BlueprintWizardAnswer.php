<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
