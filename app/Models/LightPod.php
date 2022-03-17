<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class LightPod
 *
 * @property int $id
 * @property int $blueprint_id
 * @property string|null $data
 * @property string|null $instructions
 * @property-read \App\Models\Blueprint $blueprint
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod query()
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod whereBlueprintId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|LightPod whereInstructions($value)
 * @mixin \Eloquent
 */
class LightPod extends Model
{
    /**
     * @var string
     */
    protected $table = 'light_pods';

    /**\
     * @var array
     */
    protected $fillable = [
        'blueprint_id',
        'data',
        'instructions',
    ];

    /**
     * @var bool
     */
    public $timestamps = false;

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function blueprint()
    {
        return $this->belongsTo(\App\Models\Blueprint::class);
    }
}
