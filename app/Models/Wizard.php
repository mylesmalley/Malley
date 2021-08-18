<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

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
