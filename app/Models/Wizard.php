<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Wizard extends Model
{
    use HasFactory;

    protected $table = 'wizards';

    protected $fillable = [
        'id',
        'name',
        'start', // id of first question
        'end', // id of last question

        'start_notes', // instructions or whatever
        'end_notes', // what do now?
        'base_van_id', // platform
        'completed_form_option', // option that gets triggered when the wizard is complete
    ];

    public $timestamps= false;

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
