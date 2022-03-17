<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\Tag
 *
 * @property int $id
 * @property string|null $name
 * @property int|null $base_van_id
 * @property string|null $model
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag query()
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereBaseVanId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereModel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Tag whereName($value)
 * @mixin \Eloquent
 */
class Tag extends Model
{
    /**
     * @var string
     */
    protected $table = 'tags';

    /**
     * @var array
     */
    protected $fillable = [
        'vin',
        'name',
    ];

    public $timestamps = false;

    protected function vehicles()
    {
        return $this->belongsToMany('App\Models\Vehicle',
            'vehicle_tags')->orderBy('malley_number');
    }
}
