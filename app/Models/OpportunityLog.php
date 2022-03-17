<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * App\Models\OpportunityLog
 *
 * @property int $id
 * @property int $user_id
 * @property int $opportunity_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $field
 * @property string $old_value
 * @property string $new_value
 * @property string|null $note
 * @property-read \App\Models\Opportunity $opportunity
 * @property-read \App\Models\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog query()
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereNewValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereNote($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereOldValue($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereOpportunityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OpportunityLog whereUserId($value)
 * @mixin \Eloquent
 */
class OpportunityLog extends Model
{
    /**
     * @var string
     */
    protected $table = 'opportunity_logs';

    /**
     * @var array
     */
    protected $fillable = [
        'id',
        'user_id',
        'created_at',
        'updated_at',
        'field',
        'old_value',
        'opportunity_id',
        'new_value',
        'note',
    ];

    /**
     * @return string
     */
    public function getDateFormat()
    {
        return 'Y-m-d H:i:s.u0';
    }

    /**
     * @return BelongsTo
     */
    public function opportunity(): BelongsTo
    {
        return $this->belongsTo('App\Models\Opportunity');
    }

    /**
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo('App\Models\User');
    }
}
