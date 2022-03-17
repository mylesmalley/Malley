<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;
use Modules\Blueprint\Http\Controllers\Wizard\RedirectFunctions;

class WizardQuestion extends Model
{
    use HasFactory;

    protected $table = 'wizard_questions';

    public $timestamps = false;

    protected $fillable = [
        'id', // self
        'wizard_id', // parent
        'text', // the question
        'redirect_method',
        'type',
    ];

    /**
     * @return BelongsTo
     */
    public function wizard(): BelongsTo
    {
        return $this->belongsTo(Wizard::class, 'wizard_id');
    }

    /**
     * @return HasMany
     */
    public function answers(): HasMany
    {
        return $this->hasMany(WizardAnswer::class)
            ->orderBy('position', 'DESC');
    }

    public function redirect(Collection $selectedAnswers)
    {
        $redirect = $this->attributes['redirect_method'];

        return RedirectFunctions::{$redirect}($selectedAnswers);
    }
}
