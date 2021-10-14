<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Facades\DB;


/**
 * App\Models\WizardAction
 *
 * @property int $id
 * @property int $wizard_answer_id
 * @property int $option_id
 * @property string $action
 * @property int $value
 * @method static Builder|WizardAction newModelQuery()
 * @method static Builder|WizardAction newQuery()
 * @method static Builder|WizardAction query()
 * @method static Builder|WizardAction whereAction($value)
 * @method static Builder|WizardAction whereId($value)
 * @method static Builder|WizardAction whereOptionId($value)
 * @method static Builder|WizardAction whereValue($value)
 * @method static Builder|WizardAction whereWizardAnswerId($value)
 * @mixin Eloquent
 */
class WizardAction extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'wizard_answer_id',
        'option_id',
        'action',
        'value'
    ];

    public $timestamps = false;


    /**
     * handle the changes specified
     *
     * @param int $blueprint_id
     * @return bool
     */
    public function do( int $blueprint_id ): bool
    {
        $config = Configuration::where('blueprint_id', $blueprint_id )
            ->where('option_id', $this->attributes['option_id'] )
            ->first();

        if (! $config ) return false;

        switch ( $this->attributes['action'] )
        {
            case "switch_on":
                $config->value = 1;
                break;
            case "switch_off":
                $config->value = 0;
                break;
            case "increment":
                $config->value ++;
                break;
            case "decrement":
                $config->value --;
                break;
//            case "set_value":
//                $config->value = $this->attributes['value'];
//                break;
            default:
                break;
        }

        $config->save();

        return true;
    }


    /**
     * revert the changes made by this action
     *
     * @param int $blueprint_id
     * @return bool
     */
    public function undo( int $blueprint_id ): bool
    {
        $config = DB::table('configurations')
            ->where('blueprint_id', $blueprint_id )
            ->where('option_id', $this->attributes['option_id'] )
            ->first();

        switch ( $this->attributes['action'] )
        {
            case "switch_on":
                $config->value = 0;
                break;
            case "switch_off":
                $config->value = 1;
                break;
            case "increment":
                $config->value --;
                break;
            case "decrement":
                $config->value ++;
                break;

            default:
                break;
        }

        $config->save();

        return true;
    }

    /**
     * @return BelongsTo
     */
    public function option(): BelongsTo
    {
        return $this->belongsTo(Option::class );
    }

}
